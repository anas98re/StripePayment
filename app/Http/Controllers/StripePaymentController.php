<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

// use Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create([
            'amount' => 100*100,
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'description' => 'Test Payment'
        ]);

        Session::flash('success', 'payment successful');

        return back();
    }
}
