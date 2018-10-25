<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $transactions = Transaction::with('investor.wallets', 'investor.referral')->get();

        return view('admin.transaction', [
            'transactions' => $transactions
        ]);
    }

    //Update the status of the transaction if it was successfully sent
    public function updateSend(Request $request)
    {
        $transaction = Transaction::where('transaction_id', $request->id)->first();
        if ($request->action == 'token_send')
            $transaction->send = 'true';
        if ($request->action == 'bonus_send')
            $transaction->bonus_send = 'true';
        if ($request->action == 'refs_send')
            $transaction->refs_send = 'true';
        $transaction->save();

        return [
            'status' => 'ok'
        ];
    }
}
