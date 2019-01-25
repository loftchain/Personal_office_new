<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\BonusService;
use App\Services\WidgetService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $widgetService;
    protected $bonusService;

    public function __construct(WidgetService $widgetService, BonusService $bonusService)
    {
        $this->widgetService = $widgetService;
        $this->bonusService = $bonusService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $user = Auth::user();

        $request->session()->forget('reset_password_email');

        $data['time'] = is_numeric(Input::get('time')) ? Input::get('time') : time();
        $data['btcCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('BTC', 'BTC/ETH');
        $data['ethCurrentAmount'] = $this->widgetService->calcCurrentCryptoAmount('ETH', 'ETH/ETH');
        $data['payPalCurrentAmount'] = Transaction::where('currency', 'USD')->sum('amount');
        $data['totalUSDCollected'] = $data['btcCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('BTC/USD') + $data['ethCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('ETH/USD')
           + $data['payPalCurrentAmount'] + env('PRIVATE_SALE_FUNDS');
        $data = array_merge($data, $this->bonusService->getStageInfo());
        $data['ethCurrentAmountRound'] = $this->widgetService->calcRoundCryptoAmount('ETH', 'ETH/ETH', $data['stageBegin'], $data['stageEnd']);
        $data['btcCurrentAmountRound'] = $this->widgetService->calcRoundCryptoAmount('BTC', 'BTC/ETH', $data['stageBegin'], $data['stageEnd']);
        $data['payPalCurrentAmountRound'] = Transaction::where([
            ['currency', 'USD'],
            ['date', '>=', Carbon::parse($data['stageBegin'])->format('Y-m-d')],
            ['date', '<=', Carbon::parse($data['stageEnd'])->format('Y-m-d')]])
            ->sum('amount');
        $data['authenticated'] = Auth::check();
        $data['confirmed'] = $user->confirmed;
        $data['admin'] = $user->admin;
        $data['dateNow'] = Carbon::now()->format('d.m.Y');
dd($data);
        return view('home.home', [
            'data' => $data
        ]);
    }

    public function settings()
    {

        return view('home.settings');
    }
}
