<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class TransactionController extends Controller
{
    public function agency($agency_id)
    {
        $user = User::find($agency_id);
        $transactions = $user->transactions()->orderBy('id', 'desc')->get();
        return view('admin.transaction.agency')->withUser($user)->withTransactions($transactions);
    }
}
