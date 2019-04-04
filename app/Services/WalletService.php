<?php

namespace App\Services;

use App\Helpers\ICOAPI;
//use App\Models\Transactions;
use App\Models\Investor;
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

	public static function getMyTokensFromApi(){

		$client = new Client();
		$wallets = InvestorWalletFields::where('investor_id', Auth::id())->get();
		$tokens = 0;
		foreach ($wallets as $w){
			if($w->type == 'ETH'){

				$res = $client->request('GET', 'https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.
					env('HOME_WALLET_ETH').
					'&address='. $w->wallet .'&tag=latest&apikey='. env('ETHERSCAN_API_KEY'));
				$body = json_decode($res->getBody());
				$tokens += $body->result/(18 * 10);
			}
		}
		return $tokens;
	}
}