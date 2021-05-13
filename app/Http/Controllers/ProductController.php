<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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
    public function index(User $user)
    {
        //Check if admin
        $this->authorize('view', $user);

        $products = Product::get();

        return view('product.product' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        //Check if admin
        $this->authorize('view', $user);
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //Check if admin
        $this->authorize('view', $user);

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
        // Check if user has buyed the product.
        $canReview = DB::table('orders')
                    ->where('user_id', auth()->user()->id)
                    ->where('product_id', $product->id)
                    ->exists();

        // Check if user have already a review
        $hasReview = auth()->user()->reviews()->where('product_id', $product->id)->exists();

        // Get the reviews
        $reviews = DB::table('users')
            ->join('reviews', 'users.id', '=', 'reviews.user_id')
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->select('users.name', 'reviews.*')
            ->where('reviews.product_id', $product->id)
            ->get();

        $totalVotes = DB::table('users')
            ->join('reviews', 'users.id', '=', 'reviews.user_id')
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('reviews.product_id', $product->id)
            ->sum('rate');

        // $reviewCount = Cache::remember('reviewCount'.auth()->user()->id, 
        //     now()->addSeconds(30), 
        //     function() use ($reviews) {
        //         return $reviews->count();
        //     });

        $reviewCount = $reviews->count();

        // $rateAverage = Cache::remember('rateAverage'.auth()->user()->id, 
        //     now()->addSeconds(30), 
        //     function() use ($totalVotes, $reviewCount) {
        //         if($reviewCount > 0) return ($totalVotes / $reviewCount);
        //         return 0;
        //     });

        $rateAverage = ($reviewCount != 0) ? ($totalVotes / $reviewCount) : 0;

        return view('product.show', compact('product', 'hasReview', 'reviews', 'reviewCount', 'rateAverage', 'canReview'));
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
    public function destroy(Product $product, User $user)
    {
        //Check if authorize to delete
        $this->authorize('view', $user);

        $product->destroy($product->id);
        return back()->with('status', 'A product has been removed.');
    }
}

