<?php

namespace App\Services;

use App\Models\Investor;
use App\Models\InvestorReferralFields;
use App\Models\InvestorWalletFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReferralService
{

	protected $walletService;

	public function __construct(WalletService $walletService)
	{
		$this->walletService = $walletService;
	}

	public function storeRefsToDbForAdmin()
	{
		InvestorReferralFields::truncate();

		$recountedReferrals = [];

		$referrals = Investor::where('referred_by', '!=', null)
			->whereHas('transactions', function ($query) {
				$query->where([['refs_send', 'false'], ['status', 'true']]);
			})
			->with(['wallets', 'transactions' => function ($query) {
				$query->where([['refs_send', 'false'], ['status', 'true']]);
			}])
			->get();

		foreach ($referrals as $referral) {
			$tokensSum = $this->walletService->getMyTokensFromApi($referral->transactions) * 0.1;
			$investorWallet = InvestorWalletFields::where('investor_id', $referral->referred_by)->whereIn('type', ['to', 'from_to'])->first()->wallet;

			$recountedReferrals[$referral->referred_by]['tokens'][] = $tokensSum;
			$recountedReferrals[$referral->referred_by]['wallet'] = $investorWallet;
		}

		foreach ($recountedReferrals as $key => $item) {
			InvestorReferralFields::create([
				'investor_id' => $key,
				'wallet_to' => $item['wallet'],
				'tokens' => array_sum($item['tokens'])
			]);
		}
	}

	public function getReferralData()
	{
		$referralTokens = 0;
		$referrals = Investor::where('referred_by', Auth::user()->id)
			->whereHas('transactions', function ($query) {
				$query->where('status', 'true');
			})
			->with(['transactions' => function ($query) {
				$query->where('status', 'true');
			}])
			->get();

		foreach($referrals as $r){
			$referralTokens += $this->walletService->getMyTokensFromApi($r->transactions) * 0.1;
			$r['referralTokens'] = $referralTokens;
		}

		return $referrals;


	}

}