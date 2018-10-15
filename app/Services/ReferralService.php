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

        $finalReferralSumm = [];
        $singleRefArray = [];
        $referals = Investor::where('referred_by', '!=', null)->get();
        foreach ($referals as $ref) {
            $referredWallets = InvestorWalletFields::where('investor_id', $ref->id)->get();
            if ($referredWallets) {
                foreach ($referredWallets as $rw) {
                    $transactions = Transaction::where([['from', $rw->wallet], ['refs_send', 'false']])->get();
                    foreach ($transactions as $tx) {
                        if ($tx) {
                            $singleRefArray[] = ['ref_owner_id' => $ref->referred_by,
                                'refs' => [
                                    'id' => $ref->id,
                                    'tokens' => $tx->amount_tokens
                                ]
                            ];
                        }
                    }
                }
            }
        }

        foreach ($singleRefArray as $k => $v) {
            $id = $v['ref_owner_id'];
            $result[$id][] = $v['refs']['tokens'];
        }

        foreach ($result as $key => $value) {
            $wallets = InvestorWalletFields::where('investor_id', $key)->get();
            foreach ($wallets as $w) {
                if ($w->type === 'from_to') {
                    $finalReferralSumm[] = array('id' => $key, 'wallet' => $w->wallet, 'token_sum' => array_sum($value) * 0.05);
                    break;
                } else if ($w->type === 'to') {
                    $finalReferralSumm[] = array('id' => $key, 'wallet' => $w->wallet, 'token_sum' => array_sum($value) * 0.05); //DRY as it is)
                    break;
                }
            }
        }

        foreach ($finalReferralSumm as $frs) {
            InvestorReferralFields::create([
                'user_id' => $frs['id'],
                'wallet_to' => $frs['wallet'],
                'tokens' => $frs['token_sum']
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
                                $referralData['stat'][$mr['email']]['tokens'][] = $txs['amount_tokens'] * 0.05;  //5%
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