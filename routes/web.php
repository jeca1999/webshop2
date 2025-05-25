<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerProfileController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:seller')->prefix('seller')->name('seller.')->group(function () {
    Route::get('/profile', [SellerProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [SellerProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [SellerProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', function () {
        $products = \App\Models\Product::where('seller_id', auth('seller')->id())->get();
        return view('products', compact('products'));
    })->name('products');
    Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.delete');
    Route::patch('/products/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');

      Route::get('/messages', function () {
        return view('messages'); 
    })->name('messages');

    Route::get('/messages', function () {
        return view('messages');
    })->name('messages');
});
Route::get('welcome', function () {  return view('welcome');})->name('welcome');
Route::get('/shop', function () {  return view('shop');})->name('shop');
Route::get('/prototype', function () {  return view('prototype');})->name('prototype');
Route::get('/comission', function () {  return view('comission');})->name('comission');
require __DIR__.'/auth.php';


Route::get('/seller/dashboard', function () {
    return view('sellerdashboard');
})->middleware('auth:seller')->name('seller.dashboard');

Route::get('/sellerdashboard', fn () => view('sellerdashboard'))
    ->middleware('auth:seller')
    ->name('seller.dashboard.alt');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');