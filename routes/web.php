<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\StripeCheckoutController;





Route::get('/', function () {
    return view('welcome');
});
Route::get('/donate', function () {
    return view('donate');
});

Route::post('/stripe/intent', [StripeController::class, 'createIntent']);
Route::post('/create-checkout-session', [StripeCheckoutController::class, 'createSession']);


Route::post('/donate/intent', [DonationController::class, 'createPaymentIntent']);
