<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;

class OrderController extends Controller
{

    public function index()
    {  
        // GROUP BY IN STRICT MODE
        $users = DB::table('orders')
                ->select('transaction_no', 'created_at')
                ->groupBy("transaction_no", "created_at")
                ->where('user_id', '=', auth()->user()->id)
                ->get();

        //SELECT * FROM `orders` WHERE user_id=3 GROUP BY transaction_no


        dd($users);        
        //$users = auth()->user();

        //$users = auth()->user();
        //dd($users->products[0]->name);

        return view('user.order', ['users' => $users]);
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {    
        $userOwnedTheOrder = DB::table('orders')
                    ->where('user_id', auth()->user()->id)
                    ->where('transaction_no', $id)
                    ->exists();                
        
        // CHECK IF USER DOES NOT OWNED THIS ORDER
        if (!$userOwnedTheOrder) return abort(404);//redirect()->route('orders.index');

        // Select All ORDERS OF THE AUTHENTICATED USER
        $orders = auth()->user()->products()->where('transaction_no', $id)->get();

        // SUM OF EACH AMOUNT WITH THE ALL THE SAME CORRECT TRANSACTION_NO
        $total = auth()->user()->orders()->where('transaction_no', $id)->sum('amount');

        //dd($order->products()->get());
        return view('user.show_order', [
            'orders' => $orders,
            'total' => $total
        ]);
    }

   
}
