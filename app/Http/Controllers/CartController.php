<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        session()->forget('thankyou');

        if (Auth::check()) {
            MyCart::instance('default')->restore(Auth::id());

            MyCart::instance('default')->store(Auth::id());
        }

        // Return View
        return view('product.cart');
    }

    public function store(Product $product, Request $request)
    {
        // Check if valid price format
        $price = 0;
        if (!preg_match("/^[0-9,]+$/", $product->price)) {
            $price = str_replace(',', '', $product->price);
        }

        // Validate
        $this->validate($request, [
            'product_qty' => 'required|min:1'
        ]);

        // Validate If have enough stocks
        if ($request->product_qty > $product->qty) {
            return back()->with('error', 'Product doesnt have enough stock. Please select between 1 & ' . $product->qty);
        }

        if (Auth::check()) {
            // Erase the old cart from the database
            MyCart::instance('default')->erase(Auth::id());

            // Add a product
            MyCart::add($product->id,
                $product->name,
                $request->product_qty,
                $price,
                550,
                [
                    'img' => $product->photos[0]->url,
                    'slug' => $product->slug,
                    'brand' => $product->brand,
                    'stock' => $product->qty
                ])
                ->associate('App\Models\Product');

            // Replace the Old Cart from Database with the New Cart to the Database
            MyCart::instance('default')->store(Auth::id());

            return back()->with('status', 'A new product has been added to your cart.');
        } else {
            // Add a product
            MyCart::add($product->id,
                $product->name,
                $request->product_qty,
                $price, 550,
                [
                    'img' => $product->image,
                    'slug' => $product->slug,
                    'brand' => $product->brand,
                    'stock' => $product->qty
                ])
                ->associate('App\Models\Product');

            return back()->with('status', 'A new product has been added to your cart.');
        }
    }

    // Update Quantity in Cart
    public function update(Request $request)
    {

        $rowId = $request->rowId; // Request Qty from Ajax
        $qty = $request->quantiy; // Request rowId from Ajax

        // If Authenticated update the saved cart on the database.
        if (Auth::check()) {
            // Erase the old cart from the database
            MyCart::instance('default')->erase(auth()->user()->id);

            // Update the quantity
            MyCart::update($rowId, $qty); // Will update the quantity

            // Replace the Old Cart from Database with the New Cart to the Database
            MyCart::instance('default')->store(Auth::id());
        } else {
            // Update the quantity
            MyCart::update($rowId, $qty); // Will update the quantity
        }

        // Return a json response to ajax
        return response()->json([
            "success" => true,
            'total' => MyCart::total(),
            'subtotal' => MyCart::subtotal(),
            'tax' => MyCart::tax()
        ]);

    }

    public function destroy($id)
    {
        MyCart::remove($id);
        session()->flash('status', 'An item has been removed to your cart.');

        if (Auth::check()) {
            // Delete the old cart from the  database
            MyCart::instance('default')->erase(Auth::id());

            // Add the new/modified cart to the database
            MyCart::instance('default')->store(Auth::id());
        }

        return redirect()->route('product.cart');

    }
}
