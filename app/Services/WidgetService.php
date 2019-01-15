<?php

namespace App\Services;

use App\Models\TempCurrency;
use App\Models\TempTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;


class WidgetService
{
    protected $bonusService;

    public function __construct(BonusService $bonusService)
    {
        $this->bonusService = $bonusService;
    }

    public function getTx()
    {
        $client = new Client();
        $res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('OWNER_ID'), [
            'headers' => [
                'Authorization' => 'Bearer ' . env('SELF_JWT_TOKEN')
            ]
        ]);
        $body = json_decode($res->getBody());

        return $body;
    }

    public function getCurrencyByPair($pair)
    {
        $currency = TempCurrency::all();

        $price = 0;

        foreach ($currency as $c) {
            if ($c->pair == $pair) {
                $price = $c->price;
            }
        }

        return $price;
    }

    public function calcCurrentCryptoAmount($currency, $pair)
    {
//        $tx = $this->getTx();
        $tx = TempTransaction::all();
        $amountCurrency = 0;
        $amountUsd = 0;
        $amountToken = 0;

        foreach ($tx as $t) {
//            if ($t->status == 'true') {
                if ($t->currency == $currency) {
                    $amountCurrency += $t->amount;
//                }
            }
        }

        $amountETH = ($currency == 'ETH') ? $amountCurrency : $amountCurrency * $this->getCurrencyByPair($pair);
        $amountToken = $amountETH;

        return ['currency' => $amountCurrency, 'eth' => $amountETH, 'token' => $amountToken];
    }

    public function calcRoundCryptoAmount($currency, $pair, $start, $end)
    {
        $tx = TempTransaction::where([['date', '>=', Carbon::parse($start)->format('Y-m-d')], ['date', '<=', Carbon::parse($end)->format('Y-m-d')]])->get();

        $amountCurrency = 0;

        foreach ($tx as $t) {
            if ($t->currency == $currency) {
                $amountCurrency += $t->amount;
            }
        }

        $amountETH = ($currency == 'ETH') ? $amountCurrency : $amountCurrency * $this->getCurrencyByPair($pair);
        $amountToken = $amountETH;

        return ['currency' => $amountCurrency, 'eth' => $amountETH, 'token' => $amountToken];
    }

    public function recountFiatToETH()
    {
        $ethUsd = $this->getCurrencyByPair('ETH/USD');
        $convertedValue = env('INVESTED_IN_USD') / $ethUsd;

        return $convertedValue;
    }

    public function getUserByWallet($wallet)
    {
        $user = DB::table('investors')
            ->select('investors.id', 'investors.referred_by')
            ->join('investor_wallet_fields', 'investor_wallet_fields.investor_id', '=', 'investors.id')
            ->where('investor_wallet_fields.wallet', '=', $wallet)
            ->where('investor_wallet_fields.type', 'like', '%from%')
            ->first();

        return $user ?? null;
    }
}