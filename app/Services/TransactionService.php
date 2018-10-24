<?php

namespace App\Services;

use App\Helpers\ICOAPI;
use App\Models\Investor;
use App\Models\InvestorReferralFields;
use App\Models\InvestorWalletFields;
use App\Models\TempTransaction;
use App\Models\Transaction;
use App\Models\Transactions;
use App\Models\UserWalletFields;
use App\Models\UserReferralFields;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;
use App\Services\BonusService;
use App\Services\WidgetService;

class TransactionService
{
    protected $bonusService;
    protected $walletService;
    protected $widgetService;

    public function __construct(BonusService $bonusService, WalletService $walletService, WidgetService $widgetService)
    {
        $this->bonusService = $bonusService;
        $this->walletService = $walletService;
        $this->widgetService = $widgetService;
    }

    public function getTransactions()
    {
        $client = new Client();
        $res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('OWNER_ID'));
        $body = json_decode($res->getBody());
        return $body;
    }

    public function getClosest($search, $arr)
    {
        $closest = null;
        foreach ($arr as $k => $v) {
            if ($closest === null || abs($search - $closest) > abs($v - $search)) {
                $closest = $v;
            }
        }
        return $closest;
    }

    public function appliedBonus($amountETH)
    {

        $stageInfo = $this->bonusService->getStageInfo();
        $discount = 0;

        switch (true) {
            case $amountETH < 10:
                $discount = $stageInfo['bonus<10'];
                break;
            case $amountETH >= 10 && $amountETH <= 100:
                $discount = $stageInfo['bonus10-100'];
                break;
            case $amountETH > 100:
                $discount = $stageInfo['bonus100+'];
                break;
        }
        return $discount / 100;
    }

    public function sumBonusAndTokens($tokenAmount, $amountETH)
    {
        $discount = $this->bonusService->getStageInfo()['bonus'] / 100;
        $bonus = $tokenAmount * $discount;

        return $tokenAmount + $bonus;
    }

    public function countTokens($rates, $amount, $date, $currency, $wallet)
    {
        $dateArr = [];
        $totalTokenAmount = 0;
        foreach ($rates as $r) {
            if (!in_array($r->timestamp, $dateArr)) {
                $dateArr[] = (int)$r->timestamp;
            }
        }

        $closestDate = $this->getClosest((int)$date, $dateArr);

        foreach ($rates as $r) {
//			if ((int)$r->timestamp == $closestDate) {
            switch ($currency) {
                case 'ETH':
                    if ($r->pair === 'ETH/USD') {
                        $tokenAmount = $amount * $r->price;
                        $totalTokenAmount = $this->sumBonusAndTokens($tokenAmount, $amount);
                    }
                    break;
                case 'BTC':
                    if ($r->pair === 'BTC/ETH') {
                        $tokenAmount = $amount * $this->bonusService->getLatestCurrencies('BTC/USD', $date);
                        $amountETH = $amount * $r->price;
                        $totalTokenAmount = $this->sumBonusAndTokens($tokenAmount, $amountETH);
                    }
                    break;
            }
//			}
        }

        $user = $this->widgetService->getUserByWallet($wallet);

        if (isset($user->referred_by) && !empty($user->referred_by)) {
            $urf = InvestorWalletFields::where('investor_id', '=', $user->id)->first();
            if (empty($urf)) {
                $urf = new InvestorReferralFields;
                $urf->user_id = $user->id;
                $urf->wallet_to = $wallet;
            }

            if (empty($urf->tokens_referred_by)) {
                $urf->tokens_referred_by = 0;
            }

            $urf->tokens_referred_by += $tokenAmount * env('BONUS_REFERRED_BY') / 100;
            $urf->save();
        }

        return round($totalTokenAmount, 2);
    }

    public function storeTx()
    {
        $tx = $this->getTransactions();
        $db = [];
        $rates = $this->bonusService->getLatestCurrencies();

        foreach ($tx as $t) {
            if($t->status === 'true'){
                TempTransaction::create([
                    'status' => $t->status,
                    'amount' => $t->amount,
                    'currency' => $t->currency
                ]);
            }
            $txTimestamp = strtotime($t->date);
            $closest = null;
            $info = ($t->currency == 'ETH') ? 'etherscan.io' : 'blockchain.info';
            $wallet = InvestorWalletFields::where('wallet', $t->from)->first();

            if ($wallet) {
                $db[] = [
                    'transaction_id' => $t->txId,
                    'investor_id' => $wallet->investor_id,
                    'status' => $t->status,
                    'currency' => $t->currency,
                    'from' => $t->from,
                    'amount' => $t->amount,
                    'amount_tokens' => $this->countTokens($rates, $t->amount, $t->date, $t->currency, $t->from),
                    'info' => $info,
                    'date' => $t->date
                ];

                for ($i = 0; $i < count($db); $i++) {
                    if (!Transaction::where('transaction_id', '=', $db[$i]['transaction_id'])->exists()) {
                        Transaction::create($db[$i]);
                    }
                }
            }
        }

        return $db;
    }

    public function getWalletTx($wallet)
    {
        return Transaction::where('from', $wallet)->get();
    }

    public function getDataForMyTx()
    {
        $txData = [];
        $currentUserWallets = $this->walletService->getCurrentWallets();

        foreach ($currentUserWallets as $wallet) {
            if ($wallet->type != 'to') {
                $tx = Transactions::where('from', $wallet->wallet)->get();
                $txData[] = ['wallet' => [$wallet->wallet, $wallet->currency], 'tx' => $tx];
            }
        }

        return $txData;
    }

    public function getDataForAdminTx()
    {
        $adminTxData = DB::table('transactions')
            ->select('transactions.user_id', 'transactions.status', 'transactions.currency',
                'transactions.from', 'transactions.amount',
                'transactions.amount_tokens', 'transactions.info',
                'transactions.transaction_id', 'transactions.date',
                'transactions.send', 'transactions.bonus_send', 'transactions.refs_send',
                'user_wallet_fields.type', 'user_wallet_fields.wallet',
                'users.id', 'users.email', 'users.referred_by', 'user_referral_fields.tokens')
            ->leftJoin('user_wallet_fields', 'user_wallet_fields.wallet', '=', 'transactions.from')
            ->leftJoin('users', 'users.id', '=', 'user_wallet_fields.user_id')
            ->leftJoin('user_referral_fields', 'users.id', '=', 'user_referral_fields.user_id')
            ->leftJoin('whitelist', 'whitelist.email', '=', 'users.email')
            ->get();

        foreach ($adminTxData as $k => $tx) {
            if ($tx->currency == 'BTC') {
                $transaction = InvestorWalletFields::where('investor_id', $tx->id)->where('type', 'to')->first();
                if ($transaction) {
                    $adminTxData[$k]->to = $transaction->wallet;
                }
            }
        }

        return $adminTxData;
    }
}