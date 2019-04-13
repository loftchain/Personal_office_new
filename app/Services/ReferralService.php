<?php

namespace App\Services;

use App\Models\Investor;
use App\Models\InvestorReferralFields;
use App\Models\InvestorWalletFields;
use App\Models\Transaction;
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
			foreach($referral->transactions as $rt) {
				$investorWallet = InvestorWalletFields::where('investor_id', $referral->referred_by)->whereIn('type', ['to', 'from_to'])->first()->wallet;
				$recounted['tokens'] = $rt->amount_tokens * 0.1;
				$recounted['wallet_to'] = $investorWallet;
				$recounted['transaction_id'] = $rt->transaction_id;
				$recounted['investor_id'] = $referral->referred_by;
				$recountedReferrals[] = $recounted;
			}
		}

		for ($i = 0; $i < count($recountedReferrals); $i++) {
			if (!InvestorReferralFields::where('transaction_id', '=', $recountedReferrals[$i]['transaction_id'])->exists()) {
				InvestorReferralFields::create($recountedReferrals[$i]);
			}
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