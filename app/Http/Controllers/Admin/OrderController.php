<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\OrderStatus;

class OrderController extends Controller
{
    public function agency($agency_id)
    {
        $user = User::find($agency_id);
        $statuses = OrderStatus::all();
        return view('admin.order.agency')->withUser($user)->withStatuses($statuses);
    }

    public function agencyNewOrders($agency_id)
    {
        $user = User::find($agency_id);
        $current_status = OrderStatus::where('name', 'New')->first();
        $statuses = OrderStatus::all();
        $title = 'New Orders';
        return view('admin.order.agency')
            ->withUser($user)
            ->withStatuses($statuses)
            ->withCurrent_status($current_status)
            ->withTitle($title);
    }

    public function agencyActiveOrders($agency_id)
    {
        $user = User::find($agency_id);
        $current_status = OrderStatus::where('name', 'Active')->first();
        $statuses = OrderStatus::all();
        $title = 'Active Orders';
        return view('admin.order.agency')
            ->withUser($user)
            ->withStatuses($statuses)
            ->withCurrent_status($current_status)
            ->withTitle($title);
    }

    public function agencyCompletedOrders($agency_id)
    {
        $user = User::find($agency_id);
        $current_status = OrderStatus::where('name', 'Completed')->first();
        $statuses = OrderStatus::all();
        $title = 'Completed Orders';
        return view('admin.order.agency')
            ->withUser($user)
            ->withStatuses($statuses)
            ->withCurrent_status($current_status)
            ->withTitle($title);
    }

    public function orders()
    {
        $orders = Order::orderBy('id','desc')->paginate(20);
        $statuses = OrderStatus::all();
        return view('admin.order.orders')->withOrders($orders)->withStatuses($statuses);

    }

    public function newOrders()
    {
        $statuses = OrderStatus::all();
        $new = OrderStatus::where('name', 'New')->first();
        $orders = Order::where('status_id', $new->id)->orderBy('id','desc')->paginate(20);
        $title = 'New Orders';
        return view('admin.order.orders')->withOrders($orders)->withStatuses($statuses)->withTitle($title);

    }

    public function activeOrders()
    {
        $statuses = OrderStatus::all();
        $active = OrderStatus::where('name', 'Active')->first();
        $orders = Order::where('status_id', $active->id)->orderBy('id','desc')->paginate(20);
        $title = 'Active Orders';
        return view('admin.order.orders')->withOrders($orders)->withStatuses($statuses)->withTitle($title);

    }

    public function completedOrders()
    {
        $statuses = OrderStatus::all();
        $completed = OrderStatus::where('name', 'Completed')->first();
        $orders = Order::where('status_id', $completed->id)->orderBy('id','desc')->paginate(20);
        $title = 'Completed Orders';
        return view('admin.order.orders')->withOrders($orders)->withStatuses($statuses)->withTitle($title);

    }

    public function changeStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status_id = $request->status_id;
        $order->save();
        return ('true');
    }

    public function newOrdersCount(Request $request)
    {
        if($request->timeout > 29){
            sleep(29);
        }
        else{
            sleep($request->timeout);
        }

        $status_new = OrderStatus::where('name', 'New')->first();
        $data['count'] = Order::where('status_id', $status_new->id)->count();

        return $data;
    }
}
