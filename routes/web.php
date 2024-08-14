<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Models\ProductVariant;
use App\Models\ProductVariantDT;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin'], function() {
    Route::resource('productWeb', ProductController::class);
    Route::resource('productVariantWeb', ProductVariant::class);
    Route::resource('productVariantDTWeb', ProductVariantDT::class);
    Route::resource('productCategoryWeb', ProductCategoryController::class);
});