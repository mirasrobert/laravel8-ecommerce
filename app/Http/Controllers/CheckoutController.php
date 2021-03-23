<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Exception;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;
use Stripe;


class CheckoutController extends Controller
{
    public function index()
    {
        if(auth()->user()->shipping()->doesntExist() || MyCart::instance('default')->count() == 0)
        {
            return redirect()->route('home');
        }

        return view('checkout.checkout');
    }

    public function thankyou()
    {
        if(! session()->has('thankyou'))
        {
            return redirect()->route('home');
        }

        return view('thankyou');
    }

    public function store(Request $request)
    {
        try {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Payment Intent Method 
        /*
        Stripe\PaymentIntent::create([
            'amount' => 69,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'description' => 'Laravel Test Payment',
            'setup_future_usage' => 'off_session'
        ]);
        */
         
        $amount = str_replace(array(',','.'), '', MyCart::total());
        $contents = MyCart::content()->map(function($item) {
            return $item->qty.', '.$item->name;
        })->values()->toJson();

        // Charge Payment Method
        Stripe\Charge::create ([
                "amount" => $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "ZALADA Order",
                "receipt_email" => auth()->user()->email,
                "metadata" => [
                    'contents' => $contents,
                    'quantity' => MyCart::instance('default')->count()
                ]
        ]); 

        // Remove Cart
        MyCart::instance('default')->destroy();
          
        session(["thankyou" => "Order is successfull"]);

        return redirect()->route('thankyou');

        } catch (Exception $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

}
