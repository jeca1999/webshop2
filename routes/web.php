<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Auth\TwoFactorModalController;
use Illuminate\Support\Facades\Artisan;


//returns to index page
Route::get('/', function () {
    return view('welcome');
});

//bridge client to client dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//bridge client to client profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//bridge seller account to seller profile
Route::middleware('auth:seller')->prefix('seller')->name('seller.')->group(function () {
    Route::get('/profile', [SellerProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [SellerProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [SellerProfileController::class, 'destroy'])->name('profile.destroy');

    // Seller notifications (order status)
    Route::get('/notifications', [\App\Http\Controllers\SellerOrderController::class, 'notifications'])->name('orders.notifications');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\SellerOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Seller product stock management
    Route::get('/products/manage', [\App\Http\Controllers\SellerProductController::class, 'manage'])->name('products.manage');
    Route::patch('/products/{product}/stock', [\App\Http\Controllers\SellerProductController::class, 'updateStock'])->name('products.updateStock');
});

//page connectors for navlinks
Route::get('welcome', function () {  return view('welcome');})->name('welcome');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/prototype', [ProductController::class, 'prototype'])->name('prototype');
Route::get('/comission', function () {  return view('comission');})->name('comission');
require __DIR__.'/auth.php';


// Custom 2FA challenge route to override Fortify's default
// Route::post('/two-factor-challenge', [TwoFactorModalController::class, 'store'])
//     ->middleware(['web', 'guest'])
//     ->name('two-factor.login');
// 2FA challenge is now only required for sensitive actions like password change, not at login.


Route::get('/seller/dashboard', function () {
    return view('sellerdashboard');
})->middleware('auth:seller')->name('seller.dashboard');

Route::get('/sellerdashboard', fn () => view('sellerdashboard'))
    ->middleware('auth:seller')
    ->name('seller.dashboard.alt');

Route::get('/cart', function () {
    $cart = session('cart', []);
    $products = [];
    if (!empty($cart)) {
        $products = \App\Models\Product::whereIn('id', array_keys($cart))->get();
    }
    return view('cart', compact('cart', 'products'));
})->name('cart');

Route::get('/orders', function () {
    $orders = [];
    if (Auth::check()) {
        $orders = \App\Models\Order::where('user_id', Auth::id())->latest()->get();
    }
    return view('orders', compact('orders'));
})->name('orders');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', function (\Illuminate\Http\Request $request) {
        $cart = session('cart', []);
        $productId = $request->input('product_id');
        if ($productId) {
            $product = \App\Models\Product::find($productId);
            if (!$product || $product->stock_status === 'sold_out') {
                return response()->json(['success' => false, 'message' => 'Product is sold out.'], 400);
            }
            $cart[$productId] = ($cart[$productId] ?? 0) + 1;
            session(['cart' => $cart]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    })->name('cart.add');
    Route::post('/cart/remove', function (\Illuminate\Http\Request $request) {
        $cart = session('cart', []);
        $ids = explode(',', $request->input('selected_ids', ''));
        foreach ($ids as $id) {
            unset($cart[$id]);
        }
        session(['cart' => $cart]);
        return redirect()->route('cart');
    })->name('cart.remove');
    Route::post('/profile/check-out', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'shipping_method' => 'required|string|max:255',
            'card_number' => 'required|string|min:12|max:19',
            'expiration_date' => 'required|string',
            'security_code' => 'required|string|min:3|max:4',
            'name_on_card' => 'required|string|max:255',
        ]);

        $cart = session('cart', []);
        $ids = explode(',', $request->input('selected_ids', ''));
        $selectedCart = array_intersect_key($cart, array_flip($ids));

        foreach ($ids as $id) {
            if (!isset($selectedCart[$id])) {
                $selectedCart[$id] = 1;
            }
        }

        $products = [];
        if (!empty($selectedCart)) {
            $products = Product::whereIn('id', array_keys($selectedCart))->get();
        }

        // Check for sold out products
        $soldOutProducts = $products->filter(function ($product) {
            return $product->stock_status === 'sold_out';
        });
        if ($soldOutProducts->count() > 0) {
            $names = $soldOutProducts->pluck('name')->implode(', ');
            return back()->withErrors(['One or more selected products are sold out: ' . $names]);
        }

        // Format products for order storage
        $productsData = $products->map(function ($product) use ($selectedCart) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $selectedCart[$product->id],
                'price' => $product->price
            ];
        })->toArray();

        // Generate a unique order code
        do {
            $orderCode = strtoupper(bin2hex(random_bytes(4)));
        } while (Order::where('order_code', $orderCode)->exists());

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'products' => $productsData,
            'address' => implode(', ', [
                $validated['address'],
                $validated['city'],
                $validated['region'],
                $validated['postal_code'],
                $validated['country']
            ]),
            'mode_of_payment' => 'Credit Card',
            'status' => 'Received',
            'order_code' => $orderCode,
        ]);

        // Clear the selected items from cart
        foreach ($ids as $id) {
            unset($cart[$id]);
        }
        session(['cart' => $cart]);

        // Return with success message
        return back()->with('success', 'Order placed successfully!');
    })->name('cart.checkout.selected');
    Route::get('/profile/check-out', function (\Illuminate\Http\Request $request) {
        $cart = session('cart', []);
        $products = [];
        $selectedIds = collect(explode(',', $request->query('selected_ids', '')))->filter();
        if ($selectedIds->isNotEmpty()) {
            // Only show selected products
            $products = \App\Models\Product::whereIn('id', $selectedIds)->get();
            // Build a temporary cart for display
            $cart = $products->pluck('id')->mapWithKeys(fn($id) => [$id => 1])->toArray();
        } elseif (!empty($cart)) {
            $products = \App\Models\Product::whereIn('id', array_keys($cart))->get();
        }
        return view('profile.check-out', ['cart' => $cart, 'products' => $products]);
    })->name('cart.checkout');
});

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/seller/products', [ProductController::class, 'index'])->middleware('auth:seller')->name('seller.products');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
Route::delete('/seller/products/{product}', [ProductController::class, 'destroy'])->name('seller.products.delete');
Route::post('/seller/products', [ProductController::class, 'store'])->middleware('auth:seller')->name('seller.products.store');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::patch('/seller/products/{product}', [ProductController::class, 'update'])->middleware('auth:seller')->name('seller.products.update');

Route::get('/test-approved-products', function () {
    return App\Models\Product::where('is_approved', true)->get();
});

Route::get('/test-query', function () {
    $products = Product::where('is_approved', 1)->orderBy('category')->orderBy('subcategory')->get();
    return response()->json($products);
});

// Support and policy pages
Route::view('/support/find-order', 'support.find-order')->middleware(['auth'])->name('support.find-order');
Route::view('/support/returns-refunds', 'support.returns-refunds')->middleware(['auth'])->name('support.returns-refunds');
Route::view('/policies/privacy', 'policies.privacy')->name('policies.privacy');
Route::view('/policies/terms', 'policies.terms')->name('policies.terms');


Route::get('/ping', function () {
    return 'pong';
});
Route::get('/product-image/{filename}', function ($filename) {
    $path = storage_path('app/public/product/images/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('product.image');
Route::get('/storage/products/{filename}', function ($filename) {
    $path = storage_path('app/public/products/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return Response::file($path);
})->where('filename', '.*');

Route::get('/home', function () {
    return redirect('/dashboard');
});


