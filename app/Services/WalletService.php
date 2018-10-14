<?php

namespace App\Services;

use App\Helpers\ICOAPI;
//use App\Models\Transactions;
use App\Models\InvestorWalletFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;
use App\Services\BonusService;


class WalletService
{


    public function getCurrentWallets()
    {
        return InvestorWalletFields::where('investor_id', Auth::id())->get();
    }


    public function getMyTokens(){

        $myTokenSum = 0;
        $wallets = InvestorWalletFields::where('investor_id', Auth::id())->get();
        foreach ($wallets as $w){
            $tx = Transactions::where('from', $w->wallet)->get();
            foreach ($tx as $t){
                $myTokenSum += $t->amount_tokens;
            }
        }
        return $myTokenSum;
    }
}