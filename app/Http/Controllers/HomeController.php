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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $singularOfRatings = Str::singular('Ratings');

        session()->forget('thankyou');

        $products = Product::with(['reviews', 'photos'])
            ->offset(0)
            ->limit(9)
            ->get();


        $topProducts = Product::has('orders')
            ->with('photos')
            ->limit(3)
            ->get();

        return view('home', compact('products', 'singularOfRatings', 'topProducts'));
    }

    public function test()
    {
        return view('test');
    }

}
