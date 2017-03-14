<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Paypal;
use App\Deposit;
use App\User;
use App\Cart;
use App\Order;
use App\OrderService;
use App\OrderServiceOptional;
use App\Transaction;
use App\Client;

class DepositController extends Controller
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

    public function index()
    {
        return view('agency.deposit.index');
    }

    public function payFromDeposit(Request $request, $client_id)
    {
        if(isset(Auth::user()->deposit->balance ) && Auth::user()->deposit->balance >= $request->pay ){

            //Take money from Deposit
            $balanceBefore = Auth::user()->deposit->balance;
            Auth::user()->deposit->balance = Auth::user()->deposit->balance - $request->pay;
            Auth::user()->deposit->save();

            //Save Order to database
            $order = new Order;
            $order->client_id = $client_id;
            $order->status = 'done';
            $order->paypal = 'Deposit';
            $order->price = $request->pay;
            $order->save();

            //Save Order Services to database
            $cart = Cart::where('client_id', '=', $client_id)->get();
            foreach ($cart as $cart_item) {
                $order_service = new OrderService;
                //$order_service->order()->associate($order);
                $order_service->order_id = $order->id;
                $order_service->service_id = $cart_item->service_id;
                $order_service->price = $cart_item->service->price;
                $order_service->save();

                if (isset($cart_item->cartServiceOptionals)){
                    foreach ($cart_item->cartServiceOptionals as $cartServiceOptional){
                        $order_service_optional = new OrderServiceOptional;
                        //$order_service_optional->orderService()->associate($order_service);
                        $order_service_optional->order_service_id = $order_service->id;
                        $order_service_optional->service_optional_description_id = $cartServiceOptional->serviceOptionalDescription->id;
                        $order_service_optional->price = $cartServiceOptional->serviceOptionalDescription->price;
                        $order_service_optional->save();
                    }
                }
                $cart_item->cartServiceOptionals()->delete();
                $cart_item->delete();

            }

            //Add new Transaction
            $transaction = new Transaction;
            $transaction->user()->associate(Auth::user());
            $transaction->name = 'Paying $'.$request->pay.' for Client '.Client::find($client_id)->business_name.' Services';
            $transaction->first_value = $balanceBefore;
            $transaction->last_value = Auth::user()->deposit->balance;
            $transaction->save();

            Session::flash('success', 'New Order was payed successfully from your balance!');

            return redirect()->route('order.orders', $client_id);
        }
    }

    public function depositCheckout(Request $request)
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
        $redirectUrls->setReturnUrl(route('depositDone'));
        $redirectUrls->setCancelUrl(route('depositCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect()->to( $redirectUrl );
    }

    public function depositDone(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');


        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        //Update User Balance
        $user = User::find(Auth::user()->id);
        $deposit = Deposit::where('user_id', '=', $user->id)->first();
        if(isset($deposit) && $deposit->count() > 0){
            $balanceBefore = $deposit->balance;
            $deposit->balance = $deposit->balance + $executePayment->transactions[0]->amount->total;
        }
        else{
            $balanceBefore = 0;
            $deposit = New Deposit;
            $deposit->user()->associate($user);
            $deposit->balance = $executePayment->transactions[0]->amount->total;
        }
        $deposit->save();

        //Add new Transaction
        $transaction = new Transaction;
        $transaction->user()->associate($user);
        $transaction->name = 'Adding $'.$executePayment->transactions[0]->amount->total.' to Deposit funds';
        $transaction->first_value = $balanceBefore;
        $transaction->last_value = $deposit->balance;
        $transaction->save();


        Session::flash('success', 'Deposit Funds added successfully!');

        return redirect()->route('transaction.index');
    }

    public function depositCancel()
    {
        Session::flash('error', 'Operation is not completed!');

        return redirect()->route('deposit.index');
    }
}
