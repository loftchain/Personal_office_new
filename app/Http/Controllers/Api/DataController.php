<?php

namespace App\Http\Controllers\Api;

use App\Services\BonusService;
use App\Services\WidgetService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    protected $widgetService;
    protected $bonusService;

    public function __construct(WidgetService $widgetService, BonusService $bonusService)
    {
        $this->widgetService = $widgetService;
        $this->bonusService = $bonusService;
    }

    public function index()
    {

        $stageInfo = $this->bonusService->getStageInfo();
        $data = [];
        $data['eth_usd'] = $this->bonusService->getLatestCurrencies('ETH/USD');
        $data['btc_usd'] = $this->bonusService->getLatestCurrencies('BTC/USD');
        $data['roundName'] = $stageInfo['roundName'];
        $data['currentPrice'] = $stageInfo['currentPrice'];
        $data['sumToken'] = $this->sumToken();

        return $data;
    }

    private function sumToken()
    {
        $round0 = $this->widgetService->totalUsdRound(env('ICO_START'), env('1_BONUS_3m_END'), 0.10);
        $round1 = $this->widgetService->totalUsdRound(env('1_BONUS_3m_END'), env('2_BONUS_1m_END'), 0.14);
        $round2 = $this->widgetService->totalUsdRound(env('2_BONUS_1m_END'), env('3_BONUS_1m_END'), 0.15);
        $round3 = $this->widgetService->totalUsdRound(env('3_BONUS_1m_END'), env('4_BONUS_1m_END'), 0.16);
        $round4 = $this->widgetService->totalUsdRound(env('4_BONUS_1m_END'), env('5_BONUS_1m_END'), 0.17);
        $round5 = $this->widgetService->totalUsdRound(env('5_BONUS_1m_END'), env('6_BONUS_1m_END'), 0.18);
        $round6 = $this->widgetService->totalUsdRound(env('6_BONUS_1m_END'), env('7_BONUS_1m_END'), 0.19);
        $round7 = $this->widgetService->totalUsdRound(env('7_BONUS_1m_END'), env('8_BONUS_1m_END'), 0.20);

        return $round0 + $round1 + $round2 + $round3 + $round4 + $round5 + $round6 + $round7;
    }
}
