<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class OrderController extends Controller
{
    public function agency($agency_id)
    {
        $user = User::find($agency_id);
        return view('admin.order.agency')->withUser($user);
    }
}
