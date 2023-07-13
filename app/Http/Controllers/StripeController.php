<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
//use Stripe\Stripe as Stripe;

class StripeController extends Controller
{
    public function stripe_pay(){
        return view('products.stripe');
    }

    public function stripe_send(Request $request){
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            'amount' => 1*100,
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'description' => 'test payment',

        ]);

       

        return back()->with('success', 'Successfully payment');
    }
}
