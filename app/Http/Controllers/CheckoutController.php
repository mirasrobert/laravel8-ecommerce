<?php

namespace App\Http\Controllers;


use App\Models\Checkout;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;
use Illuminate\Support\Facades\DB;
use Stripe;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    
            $customer = Stripe\Customer::create([
                'email' => auth()->user()->email,
                "source" => $request->stripeToken,
            ]);

            // Charge Payment Method
            $charge = Stripe\Charge::create ([
                    "amount" => $amount,
                    "currency" => "usd",
                    "description" => "ZALADA Order",
                    "receipt_email" => auth()->user()->email,
                    'customer' => $customer,
                    "metadata" => [
                        'contents' => $contents,
                        'quantity' => MyCart::instance('default')->count()
                    ]
            ]); 
            
            // SAVE ORDER
            $order = new Order();
            $content = MyCart::content();
            $transaction_no = $this->generateRandomString();
            //$order_no = auth()->user()->id.$this->generateRandomString().time();
            $data = [
                'content' => $content,
                'id' => $transaction_no
            ];

            $order->saveOrder($data);

            // Remove Cart
            MyCart::instance('default')->destroy();
    
            // Delete the old cart from the  database
            MyCart::instance('default')->erase(auth()->user()->id);
              
            session(["thankyou" => $data['id']]);
            
            return redirect()->route('thankyou');

            } catch (Exception $e) {
                return back()->with('Error! ' . $e->getMessage());
            }

    }

    public function generateRandomString($length = 15) {

        $characters = '012345678901234567890123456789012345678901234567890123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $transationnoDoesExist = Order::find($randomString);

        $check = (! $transationnoDoesExist) ? $randomString : $this->generateRandomString();

        return $check;
    }


}
