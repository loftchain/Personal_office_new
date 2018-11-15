<?php

namespace App\Http\Controllers;

use App\Models\InvestorHistoryFields;
use App\Models\InvestorPersonalFields;
use App\Models\InvestorWalletFields;
use App\Services\WalletService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TokensController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;

    }

    public function index()
    {
        $investor = Auth::user();
        $transactions = $investor->transactions()->paginate(10);
        $personal = $investor->personal()->first();
        $walletTo = $investor->wallets()->where('type', 'to')->first();

        return view('home.buyTokens', [
            'transactions' => $transactions,
            'personal' => $personal,
            'walletTo' => $walletTo
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

        $this->wallet_history_make($request);

        return response()->json(['wallet_added' => 'Wallet was successfully added', 'currency' => $wallet->currency]);
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
}
