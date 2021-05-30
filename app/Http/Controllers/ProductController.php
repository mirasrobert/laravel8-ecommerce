<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show','view'
        ]]);
    }

    public function index(User $user)
    {
        //Check if admin
        $this->authorize('view', $user);

        $products = Product::get();

        return view('product.product' , compact('products'));
    }

    public function create(User $user)
    {
        //Check if admin
        $this->authorize('view', $user);
        return view('product.create');
    }

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

        $slug = Str::slug($data['name']);

        // Move uploaded file to the folder with FILE PATH and FILE NAME
        $imageNameWithPath = $request->image->store('product_img', 'public');

        $image = Image::make("storage/{$imageNameWithPath}")->resize(320, 300);
        $image->save();

        // Override the image input with imagePath
        $data = array_merge($data, ['slug' => $slug], ['image' => $imageNameWithPath]);

        // IF validation returns no error create and insert new product to the database
        Product::create($data);

       // redirect
       return back()->with('status', 'A new product has been added.');
    }

    public function show(Product $product, $slug = '')
    {
         //If slug is empty or wrong
        if(empty($slug) || $product->slug != $slug) {
            return redirect()->route('product.show', ['product'=> $product, 'slug' => $product->slug]);
        }

        session()->forget('thankyou');
        $isAuthenticated = (Auth::check()) ? Auth::id() : '';

        // USING DB FACADE WITH PAGINATION
        // // Check if user has buyed the product.
        // $canReview = DB::table('orders')
        //             ->where('user_id', $isAuthenticated)
        //             ->where('product_id', $product->id)
        //             ->exists();

        // Check if user have already a review
        //$hasReview = auth()->user()->reviews()->where('product_id', $product->id)->exists();
        // $hasReview = DB::table('reviews')
        //             ->where('user_id', $isAuthenticated)
        //             ->where('product_id', $product->id)
        //             ->exists();

        //Get the reviews by product ID
        $reviews = DB::table('users')
            ->join('reviews', 'users.id', '=', 'reviews.user_id')
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->select('users.name', 'reviews.*')
            ->latest()
            ->where('reviews.product_id', $product->id)
            ->paginate(5);

        // Total Participants that reviewed.
        // $totalVotes = DB::table('users')
        //     ->join('reviews', 'users.id', '=', 'reviews.user_id')
        //     ->join('products', 'products.id', '=', 'reviews.product_id')
        //     ->where('reviews.product_id', $product->id)
        //     ->sum('rate');

        // Total Reviews Count
        //$reviewCount = $reviews->count();

        // USING ELOQUENT WITH EAGER LOADING BUT NO PAGINATION
        $product = $product->with(['reviews', 'orders'])->where('id', $product->id)->first();

        $hasReview = $product->reviews->where('user_id', $isAuthenticated)->count() > 0;

        $canReview = ($product->orders->where('user_id', $isAuthenticated)->count()) > 0;

        // Ratings
        $rateAverage = ($product->reviews->count() != 0) ? ($product->reviews->sum('rate') / $product->reviews->count()) : 0;

        return view('product.show', compact('product', 'hasReview', 'rateAverage', 'canReview', 'reviews'));
    }

    public function edit(Product $product)
    {
        //Check if admin
        $this->authorize('view', auth()->user());

        return view('product.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', auth()->user());

        $slug = Str::slug($request->name);
        $imageNameWithPath = null;


        if($request->hasFile('image')) {
            // Move uploaded file to the folder with FILE PATH and FILE NAME
            $imageNameWithPath = $request->image->store('product_img', 'public');
            $image = Image::make(public_path("storage/{$imageNameWithPath}"))->resize(320, 300);
            $image->save();
        }

        $data = array_merge($request->all(), ['slug' => $slug], ['image' => $imageNameWithPath]);

        // Check if user want to override the image
        $data = is_null($imageNameWithPath) ? array_merge($request->except(['image']), ['slug' =>  $slug]) : $data;

        $product->update($data);

        return back()->with('status', 'Product has been updated');
    }

    public function destroy(Product $product, User $user)
    {
        //Check if authorize to delete
        $this->authorize('view', $user);

        $product->destroy($product->id);
        return back()->with('status', 'A product has been removed.');
    }

    public function view()
    {
        $products = Product::paginate(6);

        return view('product.all-product' , compact('products'));
    }
}

