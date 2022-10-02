<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Tohoney E-Commerce"
        ]);

        // echo "Done";

        Session::flash('success', 'Payment successful!');
         return back();
    }
}
