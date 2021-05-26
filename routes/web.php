<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::post('/reviews/{id}', [App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');

Route::resource('orders', App\Http\Controllers\OrderController::class)->only([
    'index', 'show', 'store'
])->parameters([
    'show' => 'id'
])->names([
    'index' => 'orders.index'
]);

Route::resource('profile', App\Http\Controllers\UserController::class)->only([
    'index', 'edit'
])->names([
    'index' => 'user.index',
    'edit' => 'user.edit'
]);

Route::prefix('profile')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::patch('/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::get('/password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('user.changePassword');
    Route::patch('/password/change/{user}', [App\Http\Controllers\UserController::class, 'change'])->name('user.change');
});

Route::resource('shipping', App\Http\Controllers\ShippingController::class)->only([
    'index', 'store', 'edit'
])->names([
    'index' => 'shipping.index',
    'store' => 'shipping.store'
]);

Route::get('/shipping/edit', [App\Http\Controllers\ShippingController::class, 'edit'])->name('shipping.edit');
Route::patch('/shipping/update', [App\Http\Controllers\ShippingController::class, 'update'])->name('shipping.update');

// POPULATE AJAX DROPDOWN SHIPPING
Route::prefix('populate')->group(function () {
    Route::post('/city', [App\Http\Controllers\ShippingController::class, 'populateCity'])->name('shipping.populatecity');
    Route::post('/brgy', [App\Http\Controllers\ShippingController::class, 'populateBrgy'])->name('shipping.populatebrgy');
});

Route::resource('shop', App\Http\Controllers\ShopController::class)->only([
    'index', 'update'
])->parameters([
    'update' => 'id'
])->names([
    'index' => 'shop',
    'update' => 'shop.update'
]);


Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/thankyou', [App\Http\Controllers\CheckoutController::class, 'thankyou'])->name('thankyou');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('product.cart');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'view'])->name('product.view');
Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');

Route::put('/cart', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');

Route::post('/mycart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');

Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
