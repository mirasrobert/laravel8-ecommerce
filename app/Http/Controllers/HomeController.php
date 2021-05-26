<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(MyCart::content());

        $singularOfRatings = Str::singular('Ratings');

        session()->forget('thankyou');

        $products = Product::with(['reviews'])
                    ->offset(0)
                    ->limit(9)
                    ->get();
                    
        return view('home', compact('products', 'singularOfRatings'));
    }
   
}
