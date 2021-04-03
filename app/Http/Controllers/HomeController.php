<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Route;
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
        session()->forget('thankyou');

        $products = Product::paginate(8);

        return view('home' , [
        'products' => $products
        
        ]);

    }

    public function test()
    {
        $routeCollection = Route::getRoutes();
        dd($routeCollection);
    }

   
}
