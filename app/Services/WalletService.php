<?php

namespace App\Services;

use App\Models\InvestorWalletFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;


class WalletService
{


	public function getCurrentWallets()
	{
		return InvestorWalletFields::where('investor_id', Auth::id())->get();
	}

	public function deleteCurrentWallets()
	{
		InvestorWalletFields::where('investor_id', Auth::id())->delete();
		return response()->json(['success_wallet_restore' => 'good']);
	}

	public function numberFormatPrecision($number, $precision = 2, $separator = '.')
	{
		$numberParts = explode($separator, $number);
		$response = $numberParts[0];
		if (count($numberParts) > 1) {
			$response .= $separator;
			$response .= substr($numberParts[1], 0, $precision);
		}
		return $response;
	}

	public function getMyTokensFromApi($wallet_address = array())
	{
		$client = new Client();
		$tokens = 0;
		if (empty($wallet_address)) {
			$wallet_address = InvestorWalletFields::where('investor_id', Auth::id())->get();
		}

		foreach ($wallet_address as $w) {
			if ($w->currency == 'ETH') {

				$wallet = $w->wallet ? $w->wallet : $w->from;
				$res = $client->request('GET',
					'https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=' .
					env('HOME_WALLET_ETH') . '&address=' .
					$wallet . '&tag=latest&apikey=' . env('ETHERSCAN_API_KEY'));
				$body = json_decode($res->getBody());
				$tokens += $body->result / 1000000000000000000;
			}
		}
		return $this->numberFormatPrecision($tokens, 2, '.');
	}
}