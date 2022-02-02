<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $singularOfRatings = Str::singular('Ratings');

        session()->forget('thankyou');

        $products = Product::with(['reviews'])
            ->offset(0)
            ->limit(9)
            ->get();


        $topProducts = Product::has('orders')
            ->limit(3)
            ->get();

        return view('home', compact('products', 'singularOfRatings', 'topProducts'));
    }

    public function test()
    {
        return view('test');
    }

}
