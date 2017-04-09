<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Cart;
use App\CartServiceOptional;
use App\Client;
use App\Service;
use App\Coupon;


class CartController extends Controller
{
    public function index($client_id)
    {
        $client = Client::find($client_id);
        $cart = Cart::where('client_id', $client_id)->get();
        //return view('agency.cart.index')->withCart($cart);
        return view('agency.cart.index')->withClient($client)->withCart($cart);
    }

    public function destroy($client_id, $id)
    {
        $cart = Cart::find($id);
        $cart->cartServiceOptionals()->delete();
        $cart->delete();

        Session::flash('success', 'Service was deleted from the cart!');

        return redirect()->route('cart.index', $client_id);
    }

    public function addToCartAjax(Request $request, $client_id)
    {
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

    public function checkCoupon(Request $request)
    {
        $code = trim($request->coupon);
        $coupon = Coupon::where('code', $code)->where('user_id', Auth::user()->id)->first();
        if(isset($coupon)){
            if($coupon->expired_in <= time()){
                $data['success'] = 'success';
                $data['discount'] = $coupon->discount;
            }
            else{
                $data['error'] = 'Coupon is expired in!';
            }
        }
        else{
            $data['error'] = 'Coupon is undefined!';
        }

        return $data;
    }
}
