<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Models\Product;


//returns to index page
Route::get('/', function () {
    return view('welcome');
});

//bridge client to client dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//bridge client to client profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//bridge seller account to seller profile
Route::middleware('auth:seller')->prefix('seller')->name('seller.')->group(function () {
    Route::get('/profile', [SellerProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [SellerProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [SellerProfileController::class, 'destroy'])->name('profile.destroy');
});

//page connectors for navlinks
Route::get('welcome', function () {  return view('welcome');})->name('welcome');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/prototype', [ProductController::class, 'prototype'])->name('prototype');
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

Route::middleware(['auth'])->group(function () {
    Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
    Route::get('/fetch-messages', [MessageController::class, 'fetchMessages'])->name('fetch.messages');
    Route::get('/fetch-inbox', [MessageController::class, 'fetchInbox'])->name('fetch.inbox');
});

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/seller/products', [ProductController::class, 'index'])->middleware('auth:seller')->name('seller.products');
Route::get('/messages', function () {
        return view('messages');
    })->name('messages');
Route::get('/seller/messages', function () {
        return view('messages');
    })->middleware('auth:seller')->name('seller.messages');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
Route::delete('/seller/products/{product}', [ProductController::class, 'destroy'])->name('seller.products.delete');
Route::post('/seller/products', [ProductController::class, 'store'])->middleware('auth:seller')->name('seller.products.store');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/client/dashboard', function () {
    return view('dashboard');
    
})->middleware(['auth', 'verified'])->name('client.dashboard');

Route::get('/test-approved-products', function () {
    return App\Models\Product::where('is_approved', true)->get();
});

Route::get('/test-query', function () {
    $products = Product::where('is_approved', 1)->orderBy('category')->orderBy('subcategory')->get();
    return response()->json($products);
});