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

Route::get('/empty', function() {
    MyCart::destroy();
});

Route::get('/thankyou', [App\Http\Controllers\CheckoutController::class, 'thankyou'])->name('thankyou')->middleware('auth');
Route::post('/checkout/store', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');

Route::post('/shipping', [App\Http\Controllers\ShippingController::class, 'store'])->name('shipping.store');
Route::get('/shipping', [App\Http\Controllers\ShippingController::class, 'index'])->name('shipping');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('home.test');

Route::get('/mycart', [App\Http\Controllers\CartController::class, 'index'])->name('product.cart')->middleware('auth');;

Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store')->middleware('auth');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete')->middleware('auth');

Route::delete('/mycart/{cart}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');;

Route::put('/mycart/{id}/qty/{qty}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update')->middleware('auth');;

Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store')->middleware('auth');