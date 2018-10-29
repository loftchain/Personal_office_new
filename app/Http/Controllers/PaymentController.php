<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\InvestorWalletFields;
use App\Services\BonusService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    protected $_api_context;
    protected $bonusService;

    public function __construct(BonusService $bonusService)
    {
        $this->bonusService = $bonusService;

        $paypal_conf = \Config::get('paypal');

        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function index()
    {
        return view('test');
    }

    public function getPayment()
    {
        dd(Payment::all(['count > 10'], $this->_api_context)->getPayments());
    }

    public function payWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('tokens')/** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));
        /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Buy tokens');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('home.paypal.status'))/** Specify return URL **/
        ->setCancelUrl(route('home.paypal.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/

        try {
            $payment->create($this->_api_context);
        } catch (PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                Session::put('error', 'Connection timeout');
                return Redirect::route('test1');
            } else {
                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('test1');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('wallet', $request->wallet);

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        Session::put('error', 'Unknown error occurred');

        return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus()
    {
        $payment_id = Session::get('paypal_payment_id');
        $wallet = Session::get('wallet');

        Session::forget('paypal_payment_id');
        Session::forget('wallet');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            Session::put('error', 'Payment failed');

            return Redirect::route('home.tokens');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $currentPrice = isset($this->bonusService->getStageInfo()['currentPrice']) ? $this->bonusService->getStageInfo()['currentPrice'] : 0;
            $email = $result->getPayer()->getPayerInfo()->email;
            $transactions = $result->getTransactions()[0]->toArray();
            $investor = Investor::where('email', $email)->first();

            if(!$investor) {
                return abort(404);
            }

            $investor->wallets()->where('wallet', $wallet)->firstOrCreate([
                'currency' => 'ETH',
                'type' => 'to',
                'wallet' => $wallet,
                'active' => '1',
            ]);

            $investor->transactions()->create([
                'transaction_id' => $result->getId(),
                'status' => 'true',
                'currency' => $transactions['amount']['currency'],
                'from' => $wallet,
                'amount' => $transactions['amount']['total'],
                'amount_tokens' => $transactions['amount']['total'] / $currentPrice,
                'info' => 'PayPal',
                'date' => Carbon::now(),
            ]);

            Session::put('success', 'Payment success');

            return Redirect::route('home.tokens');
        }

        Session::put('error', 'Payment failed');

        return Redirect::route('home.tokens');
    }
}
