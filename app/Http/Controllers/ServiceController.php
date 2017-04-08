<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Service;
use App\Client;
use App\Cart;
use App\CartServiceOptional;

class ServiceController extends Controller
{
    public function index($client_id)
    {
        $client = Client::find($client_id);
        $services = Service::orderBy('sort_number', 'asc')->paginate(100);
        return view('agency.service.index')->withServices($services)->withClient($client)->withCart($this->cart($client->id));
    }

    public function show($client_id, $service_id)
    {
        $client = Client::find($client_id);
        $service = Service::find($service_id);
        return view('agency.service.show')->withService($service)->withClient($client)->withCart($this->cart($client->id));
    }

    public function services()
    {
        $services = Service::orderBy('sort_number', 'asc')->paginate(100);
        $client = Client::where('user_id', Auth::user()->id)->first();
        if(isset($client)){
            return view('agency.service.services')->withServices($services)->withClient($client)->withCart($this->cart($client->id));
        }
        else{
            return view('agency.service.no-client-services')->withServices($services);
        }
    }

    public function changeClient(Request $request)
    {

        $cart = Cart::where('client_id', $request->current_client_id)->get();
        foreach ($cart as $cart_item){
            $cart_item->client_id = $request->client_id;
            $cart_item->save();
        }
        return redirect()->route('cart.index', $request->client_id);
    }

    private function cart($client_id){
        $cart = Cart::where('client_id', '=', $client_id)->get();
        return($cart);
    }
}
