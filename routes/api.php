<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\ProductVariantDTController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('me', 'me');
    });
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function() {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('productVariants', ProductVariantController::class);
    Route::apiResource('productVariantDTs', ProductVariantDTController::class);
    Route::apiResource('productCategories', ProductCategoryController::class);
});