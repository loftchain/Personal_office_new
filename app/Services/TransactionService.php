<?php

namespace App\Services;

use App\Models\InvestorWalletFields;
use App\Models\TempTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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
		$res = $client->request('GET', env('SELF_API_URL') . '/api/tx/' . env('OWNER_ID'), [
			'headers' => [
				'Authorization' => 'Bearer ' . env('SELF_JWT_TOKEN')
			]
		]);
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

	public function sumBonusAndTokens($amount, $price)
	{
		$usdAmount = $amount * $price;
		$tokenAmount = $usdAmount / $this->bonusService->getStageInfo()['currentPrice'];
		$bonus = $tokenAmount * $this->bonusService->getStageInfo()['bonus'] / 100;
		return $tokenAmount + $bonus;
	}

	public function convertHexToDec($data)
	{
		$hex = substr($data, 2);
		return number_format(((hexdec($hex)) / 1000000000000000000), 2, '.', '');
	}

	public function grabEthEvents()
	{
		$final = [];
		$client = new Client();
		$res = $client->request('GET', 'https://api.etherscan.io/api?module=logs&action=getLogs&fromBlock=7462753&toBlock=latest&address=' . env('HOME_WALLET_ETH') . '&apikey=' . env('ETHERSCAN_API_KEY'));
		$body = json_decode($res->getBody());
		foreach ($body->result as $br) {
			if (count($br->topics) == 3) {
				$final[] = ['tokenAmount' => $this->convertHexToDec($br->data), 'transaction_id' => $br->transactionHash];
			}
		}
		return $final;
	}

	public function countTokens($rates, $amount, $date, $currency, $txId)
	{
		$dateArr = [];
		$totalTokenAmount = 0;
		foreach ($rates as $r) {
			if (!in_array(strtotime($r->timestamp), $dateArr)) {
				$dateArr[] = (int)strtotime($r->timestamp);
			}
		}
		if ($currency == 'ETH') {
			$ethTokens = $this->grabEthEvents();
			foreach ($ethTokens as $et) {
				if ($txId == $et['transaction_id']) {
					$totalTokenAmount = $et['tokenAmount'];
				}
			}
		} else {
			$closestDate = $this->getClosest((int)strtotime($date), $dateArr);
			foreach ($rates as $r) {
				if ((int)strtotime($r->timestamp) == $closestDate) {
					if ($r->pair === 'BTC/USD') {
						$totalTokenAmount = $this->walletService->numberFormatPrecision($this->sumBonusAndTokens($amount, $r->price));
					}
				}
			}
		}
		return $totalTokenAmount;
	}

	public function storeTx()
	{
		$tx = $this->getTransactions();
		$db = [];
		$rates = $this->bonusService->getLatestCurrencies();
		foreach ($tx as $t) {
			if ($t->status === 'true') {
				TempTransaction::create([
					'transaction_id' => $t->txId,
					'status' => $t->status,
					'amount' => $t->amount,
					'currency' => $t->currency,
					'from' => $t->from,
					'date' => $t->date
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
					'amount_tokens' => $this->countTokens($rates, $t->amount, $t->date, $t->currency, $t->txId),
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