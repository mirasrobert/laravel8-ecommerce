<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        session()->forget('thankyou');
        // GROUP BY IN STRICT MODE
        // $users = DB::table('orders')
        //         ->select('transaction_no', 'created_at')
        //         ->groupBy("transaction_no", "created_at")
        //         ->where('user_id', '=', auth()->user()->id)
        //         ->get();

        // $users = DB::table('products')
        //         ->join('orders', 'orders.product_id', '=' , 'products.id')
        //         ->select('products.name', 'products.price', 'products.qty', 'products.image','orders.user_id', 'orders.product_id', 'orders.created_at', 'orders.amount', 'orders.qty', 'orders.transaction_no')
        //         ->where('orders.user_id', $authenticated_user_id)
        //         ->groupBy('orders.transaction_no', 'products.name' ,'products.price', 'products.qty', 'products.image','orders.user_id', 'orders.product_id', 'orders.created_at', 'orders.amount', 'orders.qty')
        //         ->get();

        // $users = DB::table('products')
        //         ->join('orders', 'orders.product_id', '=' , 'products.id')
        //         ->select('orders.transaction_no', 'orders.created_at')
        //         ->where('orders.user_id', $authenticated_user_id)
        //         ->groupBy('orders.created_at', 'orders.transaction_no')
        //         ->get();

        $authenticated_user_id = (int) auth()->user()->id;

        $order = Order::select('transaction_no', 'created_at', 'isPaid' , 'deliveredAt')
                        ->where('user_id', $authenticated_user_id)
                        ->orderBy('created_at', 'DESC')
                        ->groupBy('created_at', 'transaction_no', 'isPaid' , 'deliveredAt')
                        ->get();
        
        return view('user.order', ['order' => $order]);
    }

    public function show($id)
    {    
        $userOwnedTheOrder = DB::table('orders')
                    ->where('user_id', auth()->user()->id)
                    ->where('transaction_no', $id)
                    ->exists();

        // Select All ORDERS WITH PRODUCTS OF THE AUTHENTICATED USER BY TRANSACTION NO
        $orders = Order::where('transaction_no', $id)->get();

        // SUM OF EACH AMOUNT WITH THE ALL THE SAME CORRECT TRANSACTION_NO
        $total = $orders->sum('amount');

        // Get the Tax
        $tax = Order::where('transaction_no', $id)->first()->tax;

        // Check If Delivered
        $isDelivered = Order::where('transaction_no', $id)->first()->deliveredAt;

        $date = Carbon::parse($isDelivered)->toDayDateTimeString();

        $user = User::with(['shipping'])->findOrFail($orders[0]->user_id);

        $shippingAddress = $user->shipping()->first();

        // Cache the data
        /*
        $orderId = Cache::remember('orderId'.auth()->user()->id, 
        now()->addSeconds(30), 
        function() use ($id) {
            return $id;
        });*/

        // $deliveredAt = Cache::remember('orderDeliveredAt'.auth()->user()->id, 
        // now()->addSeconds(30), 
        // function() use ($date) {
        //     return $date;
        // });

        $orderTotal = Cache::remember('orderTotal'.auth()->user()->id, 
        now()->addSeconds(30), 
        function() use ($total) {
            return $total;
        });

        $orderTax = Cache::remember('orderTax'.auth()->user()->id, 
        now()->addSeconds(30), 
        function() use ($tax) {
            return $tax;
        });

        // If Admin
        if(auth()->user()->role === 0)
        {
            return view('user.show_order', [
                'id' =>  $id,
                'orders' => $orders,
                'total' => $orderTotal,
                'tax' => $orderTax,
                'isDelivered' => $isDelivered,
                'deliveredAt' => $date,
                'user' => $user,
                'shippingAddress' => $shippingAddress
            ]);
        } 
        else 
        {
            if (!$userOwnedTheOrder) return abort(404);
            
            return view('user.show_order', [
                'id' =>  $id,
                'orders' => $orders,
                'total' => $orderTotal,
                'tax' => $orderTax,
                'isDelivered' => $isDelivered,
                'deliveredAt' => $date,
                'user' => $user,
                'shippingAddress' => $shippingAddress
                ]);
               
        }
    }   

}
