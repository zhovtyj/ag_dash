<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Subscription;
use App\Client;

class SubscriptionController extends Controller
{
    public function index()
    {
        $clients = Auth::user()->clients()->get();
        return view('agency.subscription.index')->withClients($clients);
    }

    public function getClientSubscriptions($client_id)
    {
        $client = Client::find($client_id);
        $subscriptions = Subscription::where('client_id', $client_id)->orderBy('id', 'desc')->paginate(20);
        return view('agency.subscription.client-subscriptions')->withSubscriptions($subscriptions)->withClient($client);
    }

    public function pdf($subscription_id)
    {
        $subscription = Subscription::find($subscription_id);
        $pdf = PDF::loadView('agency.subscription.pdf', ['subscription'=>$subscription]);
        return $pdf->stream('subscription.pdf');
    }
}
