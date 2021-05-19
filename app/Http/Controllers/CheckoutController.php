<?php

namespace App\Http\Controllers;


use App\Models\Checkout;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;
use Illuminate\Support\Facades\DB;
use Stripe;
use Illuminate\Support\Carbon;


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

        $total = str_replace(array(','), '', MyCart::total());
        $config = config("api.PAYPAL_CLIENT_ID");

        return view('checkout.checkout', [
            "PAYPAL_CLIENT_ID" => $config,
            "total" => $total
        ]);
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

    public function store(Request $request, Order $order,Product $product)
    {
        // Check for Paypal Request from Axios
        if($data = $request->paypal) {

            $details = session(["paypal" => $data]);

            $value = session('paypal');

            $this->paypalIntegration($request, $value, $order, $product);

            $response = array("msg" => "payment-success");
            return json_encode($response);
        }
    }

    protected function paypalIntegration($request, $details, Order $order,Product $product)
    {
        try {         
                $content = MyCart::content();

                $date = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $details['create_time'], 'Asia/Manila');

                $isPaid = $date->toDateTimeString();

                $tax = intval(str_replace(array(','), '', MyCart::tax()));
                
                $data = [
                    'content' => $content,
                    'id' => $details["id"],
                    'isPaid' => $isPaid,
                    'tax' => $tax
                ];

                // Save Order to the database
                $order->saveOrder($data);

                $product->updateProductQuantity($data);

                // Remove All Cart
                MyCart::instance('default')->destroy();
        
                // Delete the saved cart from the  database
                MyCart::instance('default')->erase(auth()->user()->id);
                    
                session(["thankyou" => $data['id']]); // Create session for Order #   

                // Remove Paypal Details
                session()->forget('paypal');

                //\Illuminate\Database\QueryException

           } catch (Exception $e) {
                return back()->with('Error! ' . $e->getMessage());
           }
    }

    protected function stripeIntegration(Request $request)
    {
        try {
            // Set Stripe API SECRET KEY
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
            // Payment Intent Method 
            
            Stripe\PaymentIntent::create([
                'amount' => 69,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'description' => 'Laravel Test Payment',
                'setup_future_usage' => 'off_session'
            ]);
            
             
            // Total Amount
            $amount = str_replace(array(',','.'), '', MyCart::total());

            // Metadata of products
            $contents = MyCart::content()->map(function($item) {
                return $item->qty.', '.$item->name;
            })->values()->toJson();
            
    
            // Create customer payment
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

            // Remove All Cart
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
