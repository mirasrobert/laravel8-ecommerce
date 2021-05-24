<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Get All The Products with Reviews
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);

Route::middleware('api')->group(function () {
    Auth::routes();
    Route::get('/product/{product}', [App\Http\Controllers\Api\ProductController::class, 'show']);
});





