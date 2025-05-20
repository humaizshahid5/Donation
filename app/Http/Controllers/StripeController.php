<?php

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function createIntent(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Replace this with logic to retrieve correct connected account
        $connectedAccountId = $request->input('account_id'); 

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->input('amount') * 100, // in cents
            'currency' => 'usd',
            'application_fee_amount' => 100, // platform fee in cents
            'transfer_data' => [
                'destination' => $connectedAccountId,
            ],
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }
}
