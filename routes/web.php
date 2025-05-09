<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('welcome', function () {  return view('welcome');})->name('welcome');
Route::get('/shop', function () {  return view('shop');})->name('shop');
Route::get('/prototype', function () {  return view('prototype');})->name('prototype');
Route::get('/comission', function () {  return view('comission');})->name('comission');
require __DIR__.'/auth.php';
