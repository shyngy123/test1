<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\UserController;



Route::prefix('api')->group(function () {
    Route::controller(UserController::class)->group(function () {
       Route::post('/register', 'register');
       Route::post('/login', 'login');
    });

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/order', [OrderController::class, 'placeOrder']);
        Route::post('/cart', [CartController::class, 'addToCart']);
        Route::post('/cart/{cartId}', [CartController::class, 'updateCartItem']);
       Route::delete('/cart/{cartId}', [CartController::class, 'removeCartItem']);
});

});


