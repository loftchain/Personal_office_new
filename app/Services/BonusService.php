<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class BonusService
{

    public function getLatestCurrencies($pair = null, $timestamp = null)
    {
        $client = new Client();
        $res = $client->request('GET', env('SELF_API_URL') . '/api/currencies/', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('SELF_JWT_TOKEN')
            ]
        ]);
        $body = json_decode($res->getBody());
        foreach ($body as $item) {
            if ($item->pair == $pair && $item->timestamp == $timestamp) {
                return $item->price;
            } else if ($item->timestamp == $timestamp) {
                return $item->price;
            } else if ($item->pair == $pair) {
                return $item->price;
            }
        }
        
        return $body;
    }


    public function getStageInfo()
    {
        $time = is_numeric(Input::get('time')) ? Input::get('time') : time();
        $currTime = \DateTime::createFromFormat('U', $time);
        $stageData = [];

        if ($currTime < \DateTime::createFromFormat('U', env('ICO_START'))) {
            $stageData['stage'] = 0;
            $stageData['timerBegin'] = 0;
            $stageData['timerCurrent'] = $time;
            $stageData['timerEnd'] = env('ICO_START');
            $stageData['stageBegin'] = '';
            $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
            $stageData['stageLabel'] = 'ICO';
            $stageData['stageTitle'] = 'PRIVATE-SALE STARTS IN'; //Lang::get('home/widget.beforeStart_js') . ' ' . $stageData['stageLabel'];
            $stageData['bonus'] = 0;
            $stageData['currentPrice'] = 0.10;
        } else if ($currTime < \DateTime::createFromFormat('U', env('ICO_END'))) {
            $stageData['stage'] = 1;
            $stageData['timerBegin'] = env('ICO_START');
            $stageData['timerCurrent'] = $time;
            $stageData['timerEnd'] = env('ICO_END');
            $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
            $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('ICO_END'))->format('d.m.Y');
            $stageData['stageLabel'] = 'ICO';
            $stageData['stageTitle'] = ' ENDS IN';
            $stageData['currentPrice'] = 0.10;

            switch (true) {
                case $time <= env('1_BONUS_3m_END'):
                    $stageData['roundName'] = 'PRIVATE-SALE';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('1_BONUS_3m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('1_BONUS_3m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
                    $stageData['bonus'] = 30;
                    $stageData['currentPrice'] = 0.10;
                    break;
                case $time > env('1_BONUS_3m_END') && $time <= env('2_BONUS_1m_END'):
                    $stageData['roundName'] = 'ICO-ROUND-1';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('2_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('2_BONUS_1m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('1_BONUS_3m_END'))->format('d.m.Y');
                    $stageData['bonus'] = 30;
                    $stageData['currentPrice'] = 0.14;
                    break;
                case $time > env('2_BONUS_1m_END') && $time <= env('3_BONUS_1m_END'):
                    $stageData['roundName'] = 'ICO-ROUND-2';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('3_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('3_BONUS_1m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('2_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['bonus'] = 25;
                    $stageData['currentPrice'] = 0.15;
                    break;
                case $time > env('3_BONUS_1m_END') && $time <= env('4_BONUS_1m_END'):
                    $stageData['roundName'] = 'ICO-ROUND-3';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('4_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('4_BONUS_1m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('3_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['bonus'] = 20;
                    $stageData['currentPrice'] = 0.16;
                    break;
                case $time > env('4_BONUS_1m_END') && $time <= env('5_BONUS_1m_END'):
                    $stageData['roundName'] = 'ICO-ROUND-4';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('5_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('5_BONUS_1m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('4_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['bonus'] = 15;
                    $stageData['currentPrice'] = 0.17;
                    break;
                case $time > env('5_BONUS_1m_END') && $time <= env('6_BONUS_1m_END'):
                    $stageData['roundName'] = 'ICO-ROUND-5';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('6_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('6_BONUS_1m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('5_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['bonus'] = 10;
                    $stageData['currentPrice'] = 0.18;
                    break;
                case $time > env('6_BONUS_1m_END') && $time <= env('7_BONUS_1m_END'):
                    $stageData['roundName'] = 'ICO-ROUND-6';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('7_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('7_BONUS_1m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('6_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['bonus'] = 5;
                    $stageData['currentPrice'] = 0.19;
                    break;
                case $time > env('7_BONUS_1m_END') && $time <= env('8_BONUS_1m_END'):
                    $stageData['roundName'] = 'ICO-ROUND-7';
                    $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('8_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['timerEnd'] = env('8_BONUS_1m_END');
                    $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('7_BONUS_1m_END'))->format('d.m.Y');
                    $stageData['bonus'] = 0;
                    $stageData['currentPrice'] = 0.20;
                    break;
            }

            $stageData['stageTitle'] = $stageData['roundName'] . $stageData['stageTitle'];
        } else {
            $stageData['stage'] = 2;
            $stageData['timerBegin'] = 0;
            $stageData['timerCurrent'] = 0;
            $stageData['timerEnd'] = 0;
            $stageData['stageBegin'] = \DateTime::createFromFormat('U', env('ICO_START'))->format('d.m.Y');
            $stageData['stageEnd'] = \DateTime::createFromFormat('U', env('ICO_END'))->format('d.m.Y');;
            $stageData['stageLabel'] = 'ICO';
            $stageData['stageTitle'] = Lang::get('home/widget.crowdSaleFinished_js');
            $stageData['bonus'] = 0;
        }

        return $stageData;
    }
}