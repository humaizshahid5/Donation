<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeCheckoutController extends Controller
{
    public function createSession(Request $request)
    {
       
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'amount' => 'required|numeric|min:1',
            ]);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => $validated['email'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => (int) ($validated['amount'] * 100), // convert to cents
                        'product_data' => [
                            'name' => 'Donation from ' . $validated['name'],
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => url('/thank-you'),
                'cancel_url' => url('/donation-cancelled'),
            ]);

            return response()->json(['url' => $session->url]);

        } catch (\Throwable $e) {
            \Log::error('Stripe Checkout Session error', ['message' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

