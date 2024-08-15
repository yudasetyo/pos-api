<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\ProductVariantDTController;
use App\Models\ProductVariant;
use App\Models\ProductVariantDT;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
    Route::get('register', 'showRegistrationForm')->name('register.form');
    Route::post('register', 'register')->name('register');
});


// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('product', ProductController::class);
    Route::resource('productVariant', ProductVariantController::class);
    Route::resource('productVariantDT', ProductVariantDTController::class);
    Route::resource('productCategory', ProductCategoryController::class);
});