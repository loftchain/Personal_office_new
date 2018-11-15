<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\InvestorWalletFields;
use App\Services\BonusService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1|integer',
            'wallet' => 'required'
        ]);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('tokens')
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

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
        $redirect_urls->setReturnUrl(route('home.paypal.execute'))
        ->setCancelUrl(route('home.tokens'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions([$transaction]);

        Session::put('wallet', $request->wallet);
        try {
            return $payment->create($this->_api_context);
        } catch (PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                Session::put('error', 'Connection timeout');
                return Redirect::route('home.tokens');
            } else {
                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('home.tokens');
            }
        }
    }

    public function executePayment(Request $request)
    {
        $wallet = Session::get('wallet');
        $payment_id = $request->paymentID;
        $payer_id = $request->payerID;

        Session::forget('wallet');

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($payer_id);

        try {
            $result = $payment->execute($execution, $this->_api_context);

            if ($result->getState() == 'approved') {
                $currentPrice = isset($this->bonusService->getStageInfo()['currentPrice']) ? $this->bonusService->getStageInfo()['currentPrice'] : 0;
                $transactions = $result->getTransactions()[0]->toArray();
                $investor = Investor::where('email', Auth::user()->email)->first();

                if (!$investor) {
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
            }
        } catch (PayPalConnectionException $e) {
            \Log::error(
                sprintf('PayPal execution error: %s | url: %s', $e->getMessage(), $e->getUrl())
            );

            return [
                'status' => false
            ];
        }

        return [
            'status' => true
        ];
    }
}
