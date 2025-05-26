<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerProfileController;


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