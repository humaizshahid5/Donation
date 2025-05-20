<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class DonationController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $donation = $request->input('donation_amount');
        $tip = $request->input('tip_amount');
        $fee = $request->input('processing_fee');
        $total = $request->input('total_amount');
        $accountId = $request->input('account_id');

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => round($total * 100), // cents
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'transfer_data' => [
                'destination' => $accountId,
                'amount' => round($donation * 100) // amount to sub-account
            ],
            'application_fee_amount' => round(($tip + $fee) * 100),
        ]);

        return response()->json([
            'clientSecret' => $intent->client_secret
        ]);
    }
}
