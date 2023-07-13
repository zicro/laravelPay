<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;


class PaypalController extends Controller
{
    public function goPayment(){

        return view('products.welcome');
 
     }

    public function payment(){
        $data = [];
        $data['items'] = [
            ['name' => 'Product Names',
            'price' => 2,
            'description' => 'product description',
            'qty' => 1,]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = 'invoice description';
        $data['return_url'] = route('paypal.success');
        $data['cancel_url'] = route('paypal.cancel');
        $data['total'] = 2;

        $provider = new ExpressCheckout();

        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);

        //dd($response);

        return redirect($response['paypal_link']);
    }

    public function payment_cancel(){
        dd('payment canceled by user...');
    }

    public function payment_success(Request $request) {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('payment Done Successfly ... :D');
        }
        dd('payment failed try again later ... ');

    }
}
