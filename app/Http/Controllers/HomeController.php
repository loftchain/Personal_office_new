<?php

namespace App\Http\Controllers;

use App\Services\BonusService;
use App\Services\WidgetService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        $data['totalUSDCollected'] = $data['btcCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('BTC/USD') + $data['ethCurrentAmount']['currency'] * $this->widgetService->getCurrencyByPair('ETH/USD')
            + env('PRIVATE_SALE_FUNDS');
        $data = array_merge($data, $this->bonusService->getStageInfo());
        $data['authenticated'] = Auth::check();
        $data['confirmed'] = $user->confirmed;
        $data['admin'] = $user->admin;

        return view('home.home', [
            'data' => $data
        ]);
    }

    public function settings()
    {
        return view('home.settings');
    }
}
