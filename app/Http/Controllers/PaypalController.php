<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paypal;
use Session;
use App\Order;
use App\OrderService;
use App\OrderServiceOptional;
use App\Cart;

class PaypalController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function getCheckout(Request $request, $client_id)
    {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($request->input('pay'));

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Buy Services  $'.$request->input('pay'));

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(route('getDone', $client_id));
        $redirectUrls->setCancelUrl(route('getCancel', $client_id));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect()->to( $redirectUrl );
    }

    public function getDone(Request $request, $client_id)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');


        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        //Save Order to database
        $order = new Order;
        $order->client_id = $client_id;
        $order->status = 'done';
        $order->paypal = json_encode($executePayment->transactions[0]);
        $order->price = $executePayment->transactions[0]->amount->total;
        $order->save();

        //Save Order Services to database
        $cart = Cart::where('client_id', '=', $client_id)->get();
        foreach ($cart as $cart_item) {
            $order_service = new OrderService;
            //$order_service->order()->associate($order);
            $order_service->order_id = $order->id;
            $order_service->service_id = $cart_item->service_id;
            $order_service->save();

            if (isset($cart_item->cartServiceOptionals)){
                foreach ($cart_item->cartServiceOptionals as $cartServiceOptional){
                    $order_service_optional = new OrderServiceOptional;
                    //$order_service_optional->orderService()->associate($order_service);
                    $order_service_optional->order_service_id = $order_service->id;
                    $order_service_optional->service_optional_description_id = $cartServiceOptional->serviceOptionalDescription->id;
                    $order_service_optional->save();
                }
            }
            $cart_item->cartServiceOptionals()->delete();
            $cart_item->delete();

        }

        Session::flash('success', 'New Order was payed successfully with PayPal!');

        return redirect()->route('order.orders', $client_id);
    }

    public function getCancel($client_id)
    {
        Session::flash('error', 'Operation is not completed!');

        return redirect()->route('cart.index', $client_id);
    }
}
