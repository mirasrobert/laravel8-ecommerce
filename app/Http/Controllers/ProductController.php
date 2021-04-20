<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Policies\UserPolicy;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Check if admin
        if (auth()->user()->role !== 0) {
            return redirect()->route('home');
        }

        $products = Product::get();
        return view('product.product' , [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the forms
        $data = request()->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'image' => 'required|image'
        ]);

        // Move uploaded file to the folder with FILE PATH and FILE NAME
        $imageNameWithPath = $request->image->store('product_img', 'public');

        $image = Image::make(public_path("storage/{$imageNameWithPath}"))->resize(320, 300);
        $image->save();

        // IF validation returns no error create and insert new product to the database
        Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'qty' => $data['qty'],
            'description' =>  $data['description'],
            'brand' => $data['brand'],
            'category' => $data['category'],
            'image' => $imageNameWithPath
        ]);

       // redirect
       return back()->with('status', 'A new product has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->destroy($product->id);
        return back()->with('status', 'A product has been removed.');
    }
}

