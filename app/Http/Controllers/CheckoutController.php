<?php

namespace App\Http\Controllers;


use App\Models\Checkout;
use App\Models\Order;
use App\Models\User;
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

    public function thankyou(Order $order)
    {
        if(! session()->has('thankyou'))
        {
            return redirect()->route('home');
        }

        $user = User::with('orders')->findOrFail(auth()->user()->id)->first();

        return view('thankyou', [
            'user' =>  $user
        ]);
    }

    public function store(Request $request)
    {
        
        $order = new Order();

        // SAVE ORDER
        $content = MyCart::content();
        $order_no = auth()->user()->id.$this->generateRandomString().time();

        $order->saveOrder($content, $order_no);

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
    
            // Delete the old cart from the  database
            MyCart::instance('default')->erase(auth()->user()->id);
              
            session(["thankyou" => "Order is successfull"]);
    
            return redirect()->route('thankyou');
    
            } catch (Exception $e) {
                return back()->with('Error! ' . $e->getMessage());
            }

    }

    public function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
