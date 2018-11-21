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
            ->whereHas('transactions', function ($query){
                $query->where('refs_send', 'false');
            })
            ->with('wallets', 'transactions')
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

        foreach ($recountedReferrals as $key => $item){
            InvestorReferralFields::create([
                'investor_id' => $key,
                'wallet_to' => $item['wallet'],
                'tokens' => array_sum($item['tokens'])
            ]);
        }
    }

    public function getReferralData()
    {
        $referralData = [];
        $total = 0;
        if (Auth::user()->admin == 0) {
            $myReferrals = Investor::where('referred_by', Auth::user()->id)->get();
            //----------------------wallets_to-----------------
            $myUwf = InvestorWalletFields::where('investor_id', Auth::user()->id)->get();
            foreach ($myUwf as $item) {
                if ($item->type === 'from_to' || $item->type === 'to') {
                    $referralData['wallets_to'][] = $item['wallet'];
                }
            }
            //------------------------------------------------

            foreach ($myReferrals as $mr) {
                //----------------------emails--------------------
                $uwf = InvestorWalletFields::where('investor_id', $mr->id)->get();
                //------------------------------------------------

                //----------------------wallets_from-----------------
                foreach ($uwf as $item) {
                    if ($item->type === 'from_to' || $item->type === 'from') {
                        $referralData['stat'][$mr['email']]['wallets_from'][] = $item['wallet'];

                        //----------------------tokens---------------------
                        $transactions = Transaction::where('from', $item['wallet'])->get();
                        foreach ($transactions as $txs) {
                            if ($txs->status === 'true') {
                                $referralData['stat'][$mr['email']]['tokens'][] = $txs['amount_tokens'] * 0.1;  //10%
                                $token_sum = array_sum($referralData['stat'][$mr['email']]['tokens']);
                                $referralData['stat'][$mr['email']]['token_sum'] = $token_sum;
                            }
                        }
                    }
                }
                //------------------------------------------------
            }
            //----------------------token_sum---------------------
            if (isset($referralData['stat'])) {
                foreach ($referralData['stat'] as $item) {
                    if (isset($item['tokens'])) {
                        $total += $item['token_sum'];
                    }
                }
            }

            $referralData['tokens_total'] = $total;
            //------------------------------------------------

        }

        return $referralData;
    }

}