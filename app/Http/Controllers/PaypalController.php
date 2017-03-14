<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\ServiceOptionalDescription;
use Paypal;
use Session;
use App\Order;
use App\OrderService;
use App\OrderServiceOptional;
use App\Cart;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Agreement;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

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

        Session::flash('success', 'New Order was payed successfully with PayPal!');

        return redirect()->route('order.orders', $client_id);
    }

    public function getCancel($client_id)
    {
        Session::flash('error', 'Operation is not completed!');

        return redirect()->route('cart.index', $client_id);
    }

    public function subscription(Request $request, $client_id)
    {
        $service = Service::find($request->service_id);
        $ids = $request->service_optional_ids;
        $ids = trim($ids, ",");
        $ids_arr = explode(",", $ids);

        $total_price = $service->price;

        $serviceOptionalDescription = ServiceOptionalDescription::whereIn('id', $ids_arr)->get();
        foreach ($serviceOptionalDescription as $desc){
            $total_price += $desc->price;
        }



        // Create a new instance of Plan object
        $plan = new Plan();
        // # Basic Information
        // Fill up the basic information that is required for the plan
        $plan->setName($service->name)
            ->setDescription($service->short_description)
            ->setType('fixed');
        // # Payment definitions for this billing plan.
        $paymentDefinition = new PaymentDefinition();
        // The possible values for such setters are mentioned in the setter method documentation.
        // Just open the class file. e.g. lib/PayPal/Api/PaymentDefinition.php and look for setFrequency method.
        // You should be able to see the acceptable values in the comments.
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval("1")
            ->setCycles("12")
            ->setAmount(new Currency(array('value' => $total_price, 'currency' => 'USD')));
        // Charge Models
        $chargeModel = new ChargeModel();
        $chargeModel->setType('SHIPPING')
            ->setAmount(new Currency(array('value' => $total_price, 'currency' => 'USD')));
        $paymentDefinition->setChargeModels(array($chargeModel));
        $merchantPreferences = new MerchantPreferences();


        // ReturnURL and CancelURL are not required and used when creating billing agreement with payment_method as "credit_card".
        // However, it is generally a good idea to set these values, in case you plan to create billing agreements which accepts "paypal" as payment_method.
        // This will keep your plan compatible with both the possible scenarios on how it is being used in agreement.
        $merchantPreferences->setReturnUrl(route('paypal.subscribe.done', $client_id))
            ->setCancelUrl(route('paypal.subscribe.cancel', $client_id))
            ->setAutoBillAmount("yes")
            ->setInitialFailAmountAction("CONTINUE")
            ->setMaxFailAttempts("0")
            ->setSetupFee(new Currency(array('value' => $total_price, 'currency' => 'USD')));
        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);
        // For Sample Purposes Only.
        $request = clone $plan;
        // ### Create Plan
        try {
            $output = $plan->create($this->_apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            var_dump("Created Plan", "Plan", null, $request, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        //ResultPrinter::printResult("Created Plan", "Plan", $output->getId(), $request, $output);



        //return $output;
        echo('<pre style="color:#fff;">');


        // # Update a plan
        //
        // This sample code demonstrate how you can update a billing plan, as documented here at:
        // https://developer.paypal.com/webapps/developer/docs/api/#update-a-plan
        // API used:  /v1/payments/billing-plans/<Plan-Id>
        // ### Making Plan Active
        // This example demonstrate how you could activate the Plan.
        // Retrieving the Plan object from Create Plan Sample to demonstrate the List
        /** @var Plan $createdPlan */
        $createdPlan = $output;

        try {
            $patch = new Patch();
            $value = new PayPalModel('{
	       "state":"ACTIVE"
	     }');
            $patch->setOp('replace')
                ->setPath('/')
                ->setValue($value);
            $patchRequest = new PatchRequest();
            $patchRequest->addPatch($patch);
            $createdPlan->update($patchRequest, $this->_apiContext);
            $plan = Plan::get($createdPlan->getId(), $this->_apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            var_dump("Updated the Plan to Active State", "Plan", null, $patchRequest, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

        var_dump("Updated the Plan to Active State", "Plan", $plan->getId(), $patchRequest, $plan);

        //return $plan;


        $createdPlan = $plan;

        /* Create a new instance of Agreement object
        {
            "name": "Base Agreement",
            "description": "Basic agreement",
            "start_date": "2015-06-17T9:45:04Z",
            "plan": {
              "id": "P-1WJ68935LL406420PUTENA2I"
            },
            "payer": {
              "payment_method": "paypal"
            },
            "shipping_address": {
                "line1": "111 First Street",
                "city": "Saratoga",
                "state": "CA",
                "postal_code": "95070",
                "country_code": "US"
            }
        }*/
        $agreement = new Agreement();
        $agreement->setName('Base Agreement')
            ->setDescription('Basic Agreement')
            ->setStartDate('2019-03-10T11:10:55Z');
        // Add Plan ID
        // Please note that the plan Id should be only set in this case.
        $plan = new Plan();
        $plan->setId($createdPlan->getId());
        $agreement->setPlan($plan);
        // Add Payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);
        // Add Shipping Address
        $shippingAddress = new ShippingAddress();
        $shippingAddress->setLine1('111 First Street')
            ->setCity('Saratoga')
            ->setState('CA')
            ->setPostalCode('95070')
            ->setCountryCode('US');
        $agreement->setShippingAddress($shippingAddress);
        // For Sample Purposes Only.
        $request = clone $agreement;
        // ### Create Agreement
        try {
            // Please note that as the agreement has not yet activated, we wont be receiving the ID just yet.
            $agreement = $agreement->create($this->_apiContext);
            // ### Get redirect url
            // The API response provides the url that you must redirect
            // the buyer to. Retrieve the url from the $agreement->getApprovalLink()
            // method
            $approvalUrl = $agreement->getApprovalLink();
            return redirect()->to( $approvalUrl );
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            var_dump("Created Billing Agreement.", "Agreement", null, $request, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        var_dump("Created Billing Agreement. Please visit the URL to Approve.", "Agreement", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $agreement);
        //return $agreement;


        // # Get Billing Agreement Sample
        //
        // This sample code demonstrate how you can get a billing agreement, as documented here at:
        // https://developer.paypal.com/webapps/developer/docs/api/#retrieve-an-agreement
        // API used: /v1/payments/billing-agreements/<Agreement-Id>
        // Retrieving the Agreement object from Create Agreement From Credit Card Sample
        /** @var Agreement $createdAgreement */
        $createdAgreement = $agreement;

        try {
            $agreement = Agreement::get($createdAgreement->getId(), $this->_apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            var_dump("Retrieved an Agreement", "Agreement", $agreement->getId(), $createdAgreement->getId(), $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        var_dump("Retrieved an Agreement", "Agreement", $agreement->getId(), $createdAgreement->getId(), $agreement);
        //return $agreement;


        //return redirect()->to( $redirectUrl );



        // # Get Billing Agreement Sample
        //
        // This sample code demonstrate how you can get a billing agreement, as documented here at:
        // https://developer.paypal.com/webapps/developer/docs/api/#retrieve-an-agreement
        // API used: /v1/payments/billing-agreements/<Agreement-Id>
        // Retrieving the Agreement object from Create Agreement From Credit Card Sample
        /** @var Agreement $createdAgreement */
        $createdAgreement = $agreement;

        try {
            $agreement = Agreement::get($createdAgreement->getId(), $this->_apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            var_dump("Retrieved an Agreement", "Agreement", $agreement->getId(), $createdAgreement->getId(), $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        var_dump("Retrieved an Agreement", "Agreement", $agreement->getId(), $createdAgreement->getId(), $agreement);
        //return $agreement;
    }

    public function getSubscriptionDone(Request $request, $client_id)
    {
        // ## Approval Status
        // Determine if the user accepted or denied the request
        echo('<pre>');
        $token = $request->token;
        $agreement = new \PayPal\Api\Agreement();
        try {
            // ## Execute Agreement
            // Execute the agreement by passing in the token
            $agreement->execute($token, $this->_apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            //var_dump("Executed an Agreement", "Agreement", $agreement->getId(), $token, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        //var_dump("Executed an Agreement", "Agreement", $agreement->getId(), $token, $agreement);
        // ## Get Agreement
        // Make a get call to retrieve the executed agreement details
        try {
            $agreement = \PayPal\Api\Agreement::get($agreement->getId(), $this->_apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            //var_dump("Get Agreement", "Agreement", null, null, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
       // var_dump("Get Agreement", "Agreement", $agreement->getId(), null, $agreement);

        Session::flash('success', 'New Subscription was payed successfully with PayPal!');

        return redirect()->route('agency.service.index', $client_id);

    }

    public function getSubscriptionCancel(Request $request, $client_id)
    {
        Session::flash('success', 'Subscription Error!');

        return redirect()->route('agency.service.index', $client_id);
    }
}
