<?php

namespace App\Http\Controllers\Api;

use App\Services\BonusService;
use App\Services\WidgetService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\VarDumper\Cloner\Data;

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
        Log::info($stageInfo);
        $data = [];
        $data['eth_usd'] = $this->bonusService->getLatestCurrencies('ETH/USD');
        $data['btc_usd'] = $this->bonusService->getLatestCurrencies('BTC/USD');
        $data['roundName'] = $stageInfo['roundName'] ?? '';
        $data['currentPrice'] = $stageInfo['currentPrice'];
        $data['bonus'] = $stageInfo['bonus'];
        $data['sumToken'] = $this->sumToken();
        return $data;
    }

    public static function calcData($widgetService, $bonusService){
        $dataController = new DataController($widgetService, $bonusService);
        return $dataController->index();
    }

    private function sumToken()
    {
        $round1 = $this->widgetService->totalUsdRound(env('ICO_START'), env('1_BONUS_1m_END'), 0.10);
        $round2 = $this->widgetService->totalUsdRound(env('1_BONUS_1m_END'), env('2_BONUS_1m_END'), 0.14);
        $round3 = $this->widgetService->totalUsdRound(env('2_BONUS_1m_END'), env('3_BONUS_1m_END'), 0.16);
        $round4 = $this->widgetService->totalUsdRound(env('3_BONUS_1m_END'), env('4_BONUS_1m_END'), 0.18);
        $round5 = $this->widgetService->totalUsdRound(env('4_BONUS_1m_END'), env('5_BONUS_1m_END'), 0.20);

        return $round1 + $round2 + $round3 + $round4 + $round5;
    }
}
