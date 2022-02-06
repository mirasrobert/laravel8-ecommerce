<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Photos;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show', 'view'
        ]]);
    }

    // List of Products in Table
    public function index(User $user)
    {
        //Check if admin
        $this->authorize('view', $user);

        $products = Product::with('photos')->get();

        return view('admin.product', compact('products'));
    }

    public function create(User $user)
    {
        //Check if admin
        $this->authorize('view', $user);
        return view('product.create');
    }

    public function store(Request $request, User $user)
    {
        if (!$request->hasFile('image')) {
            return response(['msg' => 'Image is required'], 400);
        }

        //Check if admin
        $this->authorize('view', $user);

        // Validate the forms
        $data = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'image' => 'required'
        ]);


        $images = array();

        $files = $request->file('image');

        foreach ($files as $file) {

            //$uploadedFileUrl = $file->store('products', 'public');
            $img = $file->getRealPath();
            $uploadedFileUrl = cloudinary()->upload($img, [
                "folder" => "img",
                "transformation" => [
                    "width" => 640,
                    "height" => 640,
                    "crop" => "fit"
                ]
            ])->getSecurePath();

            array_push($images, $uploadedFileUrl);
        }

        // IF validation returns no error create and insert new product to the database
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'brand' => $request->brand,
            'category' => $request->category,
            'slug' => Str::slug($request->name)
        ]);

        foreach ($images as $url) {
            Photos::create([
                'url' => $url,
                'imageable_id' => $product->id,
                'imageable_type' => 'App\Models\Product'
            ]);
        }

        // redirect
        return response()->json(['msg' => 'success']);
    }

    // WIDTH & HEIGHT: 114.48 , 91.22

    public function show($id, $slug = '')
    {
        $product = Product::with('photos')->findOrFail($id);

        //If slug is empty or wrong
        if (empty($slug) || $product->slug != $slug) {
            return redirect()->route('product.show', ['product' => $product, 'slug' => $product->slug]);
        }

        session()->forget('thankyou');
        $isAuthenticated = (Auth::check()) ? Auth::id() : '';

        //Get the reviews by product ID
        $reviews = DB::table('users')
            ->join('reviews', 'users.id', '=', 'reviews.user_id')
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->select('users.name', 'reviews.*')
            ->latest()
            ->where('reviews.product_id', $product->id)
            ->paginate(5);

        $hasReview = $product->reviews->where('user_id', $isAuthenticated)->count() > 0;

        $canReview = ($product->orders->where('user_id', $isAuthenticated)->count()) > 0;

        // Ratings
        $rateAverage = ($product->reviews->count() != 0) ? ($product->reviews->sum('rate') / $product->reviews->count()) : 0;

        return view('product.show', compact('product', 'hasReview', 'rateAverage', 'canReview', 'reviews'));
    }

    public function edit(Request $request, Product $product)
    {
        //Check if admin
        $this->authorize('view', auth()->user());

        $product = Product::with('photos')->find($product->id);

        return response()->json($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $id = $product->id;
        $this->authorize('update', auth()->user());
        $slug = Str::slug($request->name);
        $images = array();

        if ($request->hasFile('image')) {

            // Remove All Photos Associated in product
            $photos = $product->photos;
            foreach ($photos as $photo) {
                Photos::destroy($photo->id);
            }

            $files = $request->file('image');
            foreach ($files as $file) {
                //$uploadedFileUrl = $file->store('products', 'public');
                $img = $file->getRealPath();
                $uploadedFileUrl = cloudinary()->upload($img, [
                    "folder" => "img",
                    "transformation" => [
                        "width" => 640,
                        "height" => 640,
                        "crop" => "fit"
                    ]
                ])->getSecurePath();
                array_push($images, $uploadedFileUrl);
            }
        }

        $data = array_merge($request->except('image'), ['slug' => $slug]);

        $product->update($data);

        if (count($images) > 0) {
            // Insert new images
            foreach ($images as $url) {
                Photos::create([
                    'url' => $url,
                    'imageable_id' => $id,
                    'imageable_type' => 'App\Models\Product'
                ]);
            }
        }
        return response()->json(['status' => 'Product has been updated', 'msg' => 'success']);
    }

    public function destroy(Product $product, User $user)
    {
        //Check if authorize to delete
        $this->authorize('view', $user);

        $photos = $product->photos;
        foreach ($photos as $photo) {
            Photos::destroy($photo->id);
        }

        $product->destroy($product->id);


        return back()->with('status', 'A product has been removed.');
    }

    // All Products
    public function view()
    {
        $products = Product::with('photos')->paginate(100);

        return view('product.all-product', compact('products'));
    }
}

