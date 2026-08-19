<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function printReceipt($id)
    {
        $transaction = Transaction::with('details.product')->findOrFail($id);

        return view('transactions.receipt', compact('transaction'));
    }
}