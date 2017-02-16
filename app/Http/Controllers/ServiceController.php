<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Client;
use App\Cart;
use App\CartServiceOptional;

class ServiceController extends Controller
{
    public function index($client_id)
    {
        $client = Client::find($client_id);
        $services = Service::orderBy('id', 'desc')->paginate(100);
        return view('agency.service.index')->withServices($services)->withClient($client)->withCart($this->cart($client->id));
    }

    public function show($id)
    {
        $service = Service::find($id);
        return view('agency.service.show')->withService($service);
    }

    private function cart($client_id){
        $cart = Cart::where('client_id', '=', $client_id)->get();
        return($cart);
    }
}
