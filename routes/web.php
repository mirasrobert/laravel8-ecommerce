<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
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

// Google login
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('auth/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Profile
Route::get('/profiles', [ProfileController::class, 'index']);
Route::put('/profiles/change_avatar', [ProfileController::class, 'changeAvatar']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/reviews/{id}', [ReviewController::class, 'store'])->name('review.store');

Route::get('/my_orders', [OrderController::class, 'myOrders'])->name('my_orders');
Route::resource('orders', OrderController::class)->except(['destroy']);

Route::get('profile', [UserController::class, 'edit'])->name('user.edit');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

Route::prefix('profile')->group(function () {
    Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::patch('/password/change/{user}', [UserController::class, 'change'])->name('user.change');
});

Route::get('/shipping/edit', [ShippingController::class, 'edit'])->name('shipping.edit');
Route::patch('/shipping/update', [ShippingController::class, 'update'])->name('shipping.update');
Route::resource('shipping', ShippingController::class)->only(['index', 'store']);

// POPULATE AJAX DROPDOWN SHIPPING
Route::prefix('populate')->group(function () {
    Route::post('/city', [ShippingController::class, 'populateCity'])->name('shipping.populatecity');
    Route::post('/brgy', [ShippingController::class, 'populateBrgy'])->name('shipping.populatebrgy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/all_products', [ProductController::class, 'view'])->name('product.view');
Route::get('/product/{product}/{slug?}', [ProductController::class, 'show'])->name('product.show');
Route::resource('products', ProductController::class)->except(['show']);

Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('thankyou');
Route::prefix('checkout')->group(function () {
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
});

Route::get('/cart', [CartController::class, 'index'])->name('product.cart');
Route::prefix('cart')->group(function () {
    Route::post('/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::post('/uploads', [UploadController::class, 'upload']);


