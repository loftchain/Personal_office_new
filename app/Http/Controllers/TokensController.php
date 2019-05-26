<?php

namespace App\Http\Controllers;

use App\Models\InvestorHistoryFields;
use App\Models\InvestorPersonalFields;
use App\Models\InvestorWalletFields;
use App\Services\WalletService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\DataController;
use App\Services\BonusService;
use App\Services\WidgetService;



class TokensController extends Controller
{
    protected $walletService;
    protected $bonusService;
    protected $widgetService;

    public function __construct(WalletService $walletService, BonusService $bonusService, WidgetService $widgetService)
    {
        $this->walletService = $walletService;
        $this->bonusService = $bonusService;
        $this->widgetService = $widgetService;

    }

    public function index()
    {
        $investor = Auth::user();
        $transactions = $investor->transactions()->paginate(10);
        $personal = $investor->personal()->first();
        $walletTo = $investor->wallets()->where('type', 'to')->first();
        $calcData = DataController::calcData($this->widgetService, $this->bonusService);

        return view('home.buyTokens', [
            'transactions' => $transactions,
            'personal' => $personal,
            'walletTo' => $walletTo,
            'calcData' => $calcData
        ]);
    }

    protected function create(array $data)
    {
        return InvestorWalletFields::create([
            'investor_id' => Auth::id(),
            'currency' => $data['currency'],
            'type' => $data['type'],
            'wallet' => $data['wallet'],
        ]);
    }

    protected function wallet_history_make($wallet)
    {
        InvestorHistoryFields::create([
            'investor_id' => Auth::id(),
            'action' => 'store_wallet',
            'info_1' => 'currency: ' . $wallet->currency . '; type: ' . $wallet->type . ';',
            'info_2' => $wallet->wallet,
            'date' => Carbon::now()
        ]);
    }

    public function store_wallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wallet' => 'required|string|min:25|max:45|unique:investor_wallet_fields',
        ]);
        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        $wallet = $this->create($request->all());
        $wallet->active = '1';
        $wallet->save();

        if ($request->type === 'from') {
            $this->discordHook(Auth::user(), $wallet);
        }

        $this->wallet_history_make($request);

        return response()->json([
            'wallet_added' => 'Wallet was successfully added',
            'currency' => $wallet->currency,
            'type' => $request->type
        ]);
    }

    public function current_wallets()
    {
        $walletData = $this->walletService->getCurrentWallets();

        return response()->json(['currentWallets' => $walletData]);
    }

    public function description_view($currency)
    {
        return view('home.wallet_help.description')->with('currency', $currency);
    }

    public function send_usd_proposal(Request $request)
    {
        $user = Auth::user();
        $userPersonal = InvestorPersonalFields::where('investor_id', $user->id)->first();
        $wallet = InvestorWalletFields::where('investor_id', $user->id)->where('type', 'to')->first();

        $mailData = [
            'email' => $user->email,
            'name' => $userPersonal->name_surname,
            'address' => $userPersonal->permanent_address,
            'phone' => $userPersonal->contact_number,
            'sourceOfFunds' => $userPersonal->source_of_funds,
            'wallet' => $wallet->wallet,
            'amount' => $request['usdAmount'],
        ];
//          todo Уточнить
//        Mail::to(env('OWNER_EMAIL'))->send(new SendFiatRequest($mailData));

        return response()->json(['usd_request_sent' => 'good']);
    }

    protected function discordHook($user, $wallet)
    {
        $ethWallet = $user->wallets()->where('type', 'to')->first();

        date_default_timezone_set('Europe/Moscow');

        $send_obg = [
            'user_id' => '**investor_id: **' . $user['id'],
            'email' => '**email: **' . $user['email'],
            'name' => '**name: **' . $user['name'],
            'btc_wallet' => '**BTC wallet: **' . $wallet->wallet ,
            'eth_wallet' => '**ETH wallet: **' . $ethWallet->wallet ?? null,
            'ip' => '**ip: **' . $_SERVER['REMOTE_ADDR'],
            'user_agent' => '**user_agent: **' . $_SERVER['HTTP_USER_AGENT'],
            '**-----------------------------------------------------------------------------------------------------------**',
        ];

        if (env('APP_ENV') !== 'local') {
            $str = implode("\n", $send_obg);
            $client = new Client();
            try {
                $client->request('POST', 'https://discordapp.com/api/webhooks/515507933484941323/bBRGVhm2MJZXI0BCU8l76cnNIY9V1d7O8ojFpuZ3mI7Okftc0gv9E0baK1GSNPDOEGjG', [
                    'json' => [
                        'content' => $str,
                    ]
                ]);
            } catch (GuzzleException $e) {

            }
        }
    }
}
