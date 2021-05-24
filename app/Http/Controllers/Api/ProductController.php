<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{

    public function index() {

        $product = Product::with(['reviews'])
        ->offset(0)
        ->limit(9)
        ->get();    
        
        return $product;
    }

    public function show(Product $product) {

        
        $isAuthenticated = (Auth::check()) ? Auth::id() : '';

        //Get the reviews by product ID
        $reviews = DB::table('users')
            ->join('reviews', 'users.id', '=', 'reviews.user_id')
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->select('users.name', 'reviews.*')
            ->latest()
            ->where('reviews.product_id', $product->id)
            ->paginate(5);

        // USING ELOQUENT WITH EAGER LOADING BUT NO PAGINATION
        $product = $product->with(['reviews', 'orders'])->where('id', $product->id)->first();
        
        $hasReview = $product->reviews->where('user_id', $isAuthenticated)->count() > 0;
        
        $canReview = ($product->orders->where('user_id', Auth::id())->count()) > 0;

        dd(Auth::id());

        // Ratings
        $rateAverage = ($product->reviews->count() != 0) ? ($product->reviews->sum('rate') / $product->reviews->count()) : 0;

        $json = [
            'reviews' => $reviews,
            'product' => $product,
            'hasReview' => $hasReview,
            'canReview' => $canReview
        ];

        return json_encode($json);

    }
}
        
