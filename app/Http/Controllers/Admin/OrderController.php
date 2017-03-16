<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;

class OrderController extends Controller
{
    public function agency($agency_id)
    {
        $user = User::find($agency_id);
        return view('admin.order.agency')->withUser($user);
    }

    public function orders()
    {
        $orders = Order::orderBy('id','desc')->paginate(20);
        return view('admin.order.orders')->withOrders($orders);

    }
}
