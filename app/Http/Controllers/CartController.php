<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the product of the user
        //$posts = Post::with(['user', 'likes'])->paginate(20);
        // Get the cart of the authenticated useR
        return view('product.cart');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */     
    public function store(Product $product, Request $request)
    {
        // Add a product
        MyCart::add($product->id, $product->name, $request->product_qty, $product->price, ['img' => $product->image])
                ->associate('App\Models\Product');
        return back()->with('status', 'A new product has been added to your cart.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $qty)
    {
        if ($qty > 20) {
            
            session()->flash('error', 'Max quantity of 20.');
            return redirect()->route('cart.index');
        }

        MyCart::update($id, $qty);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        $cart->destroy($cart->id);
        return back()->with('status', 'A product has been removed to your cart.');*/

        MyCart::remove($id);
        session()->flash('status', 'An item has been removed to your cart.');
        return redirect()->back();

    }
}
