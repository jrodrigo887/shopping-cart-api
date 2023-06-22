<?php

use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class);
// Route::apiResource('checkouts', \App\Http\Controllers\Api\CheckoutController::class);
// Route::apiResource('checkouts.products', \App\Http\Controllers\Api\ProductController::class)->only(['index']);
// Route::post('/checkouts/{checkoutId}/products', [CheckoutController::class, 'addProductsTocheckout']);

Route::get('/checkouts', [CheckoutController::class, 'index']);
Route::get('/checkouts/{id}', [CheckoutController::class, 'show']);
Route::post('/checkouts', [CheckoutController::class, 'store']);
Route::put('/checkouts/{id}', [CheckoutController::class, 'update']);
Route::delete('/checkouts/{id}', [CheckoutController::class, 'destroy']);
Route::post('/checkouts/{checkoutId}/products', [CheckoutController::class, 'addProducts']);
Route::delete('/checkouts/{checkoutId}/products/{productId}', [CheckoutController::class, 'removeProduct']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
