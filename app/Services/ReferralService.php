<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\Transaction;
use App\Models\Investor;
use App\Models\InvestorReferralFields;
use App\Models\InvestorWalletFields;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;

class ReferralService
{

    public function storeRefsToDbForAdmin()
    {
        InvestorReferralFields::truncate();

        $recountedReferrals = [];

        $referrals = Investor::where('referred_by', '!=', null)
            ->whereHas('transactions', function ($query) {
                $query->where([['refs_send', 'false'], ['status', 'true']]);
            })
            ->with(['wallets', 'transactions' => function($query){
                $query->where([['refs_send', 'false'], ['status', 'true']]);
            }])
            ->get();

        foreach ($referrals as $referral) {
            $tokensSum = $referral->transactions->sum('amount_tokens') * 0.1;
            $investorWallet = InvestorWalletFields::where('investor_id', $referral->referred_by)->whereIn('type', ['to', 'from_to'])->first()->wallet;
            $referral->transactions()->update([
                'refs_send' => 'true'
            ]);

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
        $referrals = Investor::where('referred_by', Auth::user()->id)
            ->whereHas('transactions', function ($query) {
                $query->where('status', 'true');
            })
            ->with(['transactions' => function ($query) {
                $query->where('status', 'true');
            }])
            ->get();

        return $referrals;

    }

}