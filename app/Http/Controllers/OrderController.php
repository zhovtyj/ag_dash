<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function getClientOrders($client_id)
    {

        $client = Client::find($client_id);
        $orders = Order::where('client_id', '=', $client_id)->orderBy('id', 'desc')->paginate(20);
        return view('agency.order.orders')->withOrders($orders)->withClient($client);
    }
}
