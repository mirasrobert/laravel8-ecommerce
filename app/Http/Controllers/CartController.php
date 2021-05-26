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
     * Display a listing of the caresource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        session()->forget('thankyou');
        // Get the product of the user
        //$posts = Post::with(['user', 'likes'])->paginate(20);

        /* GET THE USERS CART */
        //MyCart::instance('default')->erase(Auth::id());
        
        if(Auth::check())
        {
            MyCart::instance('default')->restore(Auth::id());

            MyCart::instance('default')->store(Auth::id());
        }

        // Return View
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
     * Store a newly product resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */     
    public function store(Product $product, Request $request)
    {
        // Validate
        $this->validate($request, [
            'product_qty' => 'required|min:1|max:10'
        ]);

        // Valdiate If have enough stocks
        if($request->product_qty > $product->qty) {
            return back()->with('error', 'Product doesnt have enough stock. Please select between 1 & '.$product->qty);
        }
        
        if(Auth::check())
        {
            // Erase the old cart from the database
            MyCart::instance('default')->erase(Auth::id());

            // Add a product
            MyCart::add($product->id, $product->name, $request->product_qty, $product->price, 550, ['img' => $product->image])
            ->associate('App\Models\Product');

            // Replace the Old Cart from Database with the New Cart to the Database
            MyCart::instance('default')->store(Auth::id());

            return back()->with('status', 'A new product has been added to your cart.');
        }
        else
        {
            // Add a product
            MyCart::add($product->id, $product->name, $request->product_qty, $product->price, 550, ['img' => $product->image])
            ->associate('App\Models\Product');

            return back()->with('status', 'A new product has been added to your cart.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $rowId = $request->rowId; // Request Qty from Ajax
            $qty = $request->quantiy; // Request rowId from Ajax

            // If request is empty
            if(is_null($rowId) || is_null($qty)) {
                // IF server error
                return response()->json([
                    "success" => false
                ]);
            }

            // If Authenticated update the saved cart on the database.
            if(Auth::check()) {
                // Erase the old cart from the database
                MyCart::instance('default')->erase(Auth::id());

                // Update the quantity
                MyCart::update($rowId,$qty); // Will update the quantity

                // Replace the Old Cart from Database with the New Cart to the Database
                MyCart::instance('default')->store(Auth::id());
            } else {
                // Update the quantity
                MyCart::update($rowId,$qty); // Will update the quantity
            }

            // Return a json response to ajax
            return response()->json([
                "success" => true
            ]);

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

        if(Auth::check())
        {
            // Delete the old cart from the  database
            MyCart::instance('default')->erase(Auth::id());

            // Add the new/modified cart to the database
            MyCart::instance('default')->store(Auth::id());
        }

        //MyCart::instance('default')->merge('shoppingcart', MyCart::discount(), MyCart::tax(), null, 'default');

        return redirect()->route('product.cart');

    }
}
