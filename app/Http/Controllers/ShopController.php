<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index() {

        
        $this->authorize('view', auth()->user());
        $orders = Order::select('transaction_no', 'created_at', 'deliveredAt')
                        ->orderBy('created_at', 'ASC')
                        ->groupBy('created_at', 'transaction_no', 'deliveredAt')
                        ->get();

        //$order = Order::oldest()->get();

        return view('admin.shop', compact('orders'));
    }

    // mark as delivered
    public function update($id)
    {
        $this->authorize('update', auth()->user());
        $orders = Order::where('transaction_no', $id)->get();

        try {
            foreach ($orders as $key => $value) {
    
                $order = Order::findOrFail($value->id);
    
                $order->update([
                    'deliveredAt' => now()
                ]);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            die('SOMETHING WENT WRONG '.$e->getMessage());
        }

        return redirect()->back();

    }

}
