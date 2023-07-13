<?php

use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


// Paypal payment routes
Route::get('pay', [PaypalController::class, 'goPayment'])->name('payment.go');

Route::get('payment',[PaypalController::class, 'payment'])->name('payment');
Route::get('payment_cancel',[PaypalController::class, 'payment_cancel'])->name('paypal.cancel');
Route::get('payment_success',[PaypalController::class, 'payment_success'])->name('paypal.success');

// Stripe payment routes
Route::get('stripe_pay', [StripeController::class, 'stripe_pay'])->name('stripe.pay');
Route::post('stripe_send', [StripeController::class, 'stripe_send'])->name('stripe.post');

