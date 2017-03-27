<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\OrderStatus;
use App\Subscription;

class SubscriptionController extends Controller
{
    public function agency($agency_id)
    {
        $user = User::find($agency_id);
        $statuses = OrderStatus::all();
        return view('admin.subscription.agency')->withUser($user)->withStatuses($statuses);
    }

    public function agencyNewSubscriptions($agency_id)
    {
        $user = User::find($agency_id);
        $current_status = OrderStatus::where('name', 'New')->first();
        $statuses = OrderStatus::all();
        $title = 'New Subscriptions';
        return view('admin.subscription.agency')
            ->withUser($user)
            ->withStatuses($statuses)
            ->withCurrent_status($current_status)
            ->withTitle($title);
    }

    public function agencyActiveSubscriptions($agency_id)
    {
        $user = User::find($agency_id);
        $current_status = OrderStatus::where('name', 'Active')->first();
        $statuses = OrderStatus::all();
        $title = 'Active Subscriptions';
        return view('admin.subscription.agency')
            ->withUser($user)
            ->withStatuses($statuses)
            ->withCurrent_status($current_status)
            ->withTitle($title);
    }

    public function agencyCompletedSubscriptions($agency_id)
    {
        $user = User::find($agency_id);
        $current_status = OrderStatus::where('name', 'Completed')->first();
        $statuses = OrderStatus::all();
        $title = 'Completed Subscriptions';
        return view('admin.subscription.agency')
            ->withUser($user)
            ->withStatuses($statuses)
            ->withCurrent_status($current_status)
            ->withTitle($title);
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::orderBy('id','desc')->paginate(20);
        $statuses = OrderStatus::all();
        return view('admin.subscription.subscriptions')->withSubscriptions($subscriptions)->withStatuses($statuses);

    }

    public function newSubscriptions()
    {
        $statuses = OrderStatus::all();
        $new = OrderStatus::where('name', 'New')->first();
        $subscriptions = Subscription::where('status_id', $new->id)->orderBy('id','desc')->paginate(20);
        $title = 'New Subscriptions';
        return view('admin.subscription.subscriptions')->withSubscriptions($subscriptions)->withStatuses($statuses)->withTitle($title);

    }

    public function activeSubscriptions()
    {
        $statuses = OrderStatus::all();
        $active = OrderStatus::where('name', 'Active')->first();
        $subscriptions = Subscription::where('status_id', $active->id)->orderBy('id','desc')->paginate(20);
        $title = 'Active Subscriptions';
        return view('admin.subscription.subscriptions')->withSubscriptions($subscriptions)->withStatuses($statuses)->withTitle($title);

    }

    public function completedSubscriptions()
    {
        $statuses = OrderStatus::all();
        $completed = OrderStatus::where('name', 'Completed')->first();
        $subscriptions = Subscription::where('status_id', $completed->id)->orderBy('id','desc')->paginate(20);
        $title = 'Completed Subscriptions';
        return view('admin.subscription.subscriptions')->withSubscriptions($subscriptions)->withStatuses($statuses)->withTitle($title);

    }

    public function changeStatus(Request $request)
    {
        $subscription = Subscription::find($request->subscription_id);
        $subscription->status_id = $request->status_id;
        $subscription->save();
        return ('true');
    }


    public function newSubscriptionsCount(Request $request)
    {
        if($request->timeout > 29){
            sleep(29);
        }
        else{
            sleep($request->timeout);
        }

        $status_new = OrderStatus::where('name', 'New')->first();
        $data['count'] = Subscription::where('status_id', $status_new->id)->count();

        return $data;
    }
}
