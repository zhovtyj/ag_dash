<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\CartServiceOptional;
use App\Client;
use App\Service;


class CartController extends Controller
{
    public function addToCartAjax(Request $request, $client_id){

//        $user = User::find(Auth::user()->id);
//        $service = Service::find($request->id);
//        $cart = New Cart;
//
//        $cart->user()->associate($user);
//        $cart->service()->associate($service);
//        $cart->price = $service->price;
//        $cart->count = 1;
//
//        $cart->save();

        $client = Client::find($client_id);
        $service = Service::find($request->id);
        $cart = New Cart;

        $cart->client()->associate($client);
        $cart->service()->associate($service);
        $cart->save();


        for($i=0; $i < count($request->description_ids); $i++){
            $cartServiceOptional = new CartServiceOptional;
            $cartServiceOptional->cart()->associate($cart);
            $cartServiceOptional->service_optional_description_id = $request->description_ids[$i];
            $cartServiceOptional->save();
        }

        return($cart);
    }
}
