<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('agency.transaction.index')->withTransactions($transactions);
    }
}
