@php
// Only use the $cart and $products passed to the view, do not default to session cart
@endphp

<x-app-layout>
    <header class="w-full px-2 sm:px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
        <a href="{{ url('/') }}" class="text-3xl font-bold text-center md:text-left text-black dark:text-white">3ELLLE</a>
        <div class="relative">
            <button id="profile-dropdown-toggle" class="flex items-center gap-2 px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:bg-blue-500 hover:text-white transition focus:outline-none">
                <span>Account</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
            <div id="profile-dropdown-menu" class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded shadow-lg z-50 hidden">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Edit Profile</a>
                <form method="POST" action="{{ url('logout', [], true) }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <nav class="w-full flex gap-4 flex-wrap justify-center mt-4 mb-8">
        <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Dashboard</a>
        <a href="{{ url('/orders') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Orders</a>
        <a href="{{ url('/cart') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Cart</a>
    </nav>
    <div class="py-12 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 p-0 md:p-6">
            <!-- Checkout Form (Left) -->
            <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8 md:mb-0">
                <h2 class="text-2xl font-bold mb-4 text-[#1b1b18] dark:text-white">Checkout Form</h2>
                <div class="flex gap-4 mb-4">
                    <button class="bg-gray-900 text-white w-1/2 px-4 py-2 rounded hover:bg-gray-800">Google Pay</button>
                    <button class="bg-gray-900 text-white w-1/2 px-4 py-2 rounded hover:bg-gray-800">Apple Pay</button>
                </div>
                <div class="text-center text-gray-500 my-4">or</div>
                @if ($errors->any())
                    <div class="mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500 text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
                @endif
                <form class="space-y-4" method="POST" action="{{ route('cart.checkout.selected', [], true) }}">
                    @csrf
                    <input type="hidden" name="selected_ids" value="{{ implode(',', array_keys($cart ?? [])) }}">
                    <div>
                        <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">Country/Region</label>
                        <input type="text" name="country" value="{{ old('country') }}" placeholder="Country/Region" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Address" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                    </div>
                    <div>
                        <input type="text" name="apartment" value="{{ old('apartment') }}" placeholder="Apartment, suite, etc. (option)" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="Postal code" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">Region</label>
                            <input type="text" name="region" value="{{ old('region') }}" placeholder="Region" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#1b1b18] dark:text-white">Shipping method</label>
                        <input type="text" name="shipping_method" value="{{ old('shipping_method') }}" placeholder="Enter your shipping address" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                    </div>
                    <h3 class="text-lg font-semibold mt-6 text-[#1b1b18] dark:text-white">Payment</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="card_number" value="{{ old('card_number') }}" placeholder="Card Number" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                        <input type="text" name="expiration_date" value="{{ old('expiration_date') }}" placeholder="Expiration Date" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                        <input type="text" name="security_code" value="{{ old('security_code') }}" placeholder="Security Code" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                    </div>
                    <input type="text" name="name_on_card" value="{{ old('name_on_card') }}" placeholder="Name on Card" class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 mt-4 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white" required />
                    <div class="flex items-center gap-2 mt-2">
                        <input type="checkbox" id="sameAsShipping" class="border-gray-300 dark:border-gray-700 rounded" />
                        <label for="sameAsShipping" class="text-sm text-[#1b1b18] dark:text-white">Use shipping address as billing address</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="rememberMe" class="border-gray-300 dark:border-gray-700 rounded" />
                        <label for="rememberMe" class="text-sm text-[#1b1b18] dark:text-white">Save my information for a faster checkout</label>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md mt-4 hover:bg-blue-500 w-full">Pay Now</button>
                </form>
            </div>
            <!-- Product List (Right) -->
            <div class="w-full md:w-1/2 flex flex-col bg-white dark:bg-gray-800 rounded-lg shadow p-6 relative">
                <h3 class="text-xl font-semibold mb-4 text-[#1b1b18] dark:text-white">Product List</h3>
                @if(!empty($cart) && count($products))
                    <div class="overflow-y-auto" style="max-height: 340px;">
                        <table class="w-full text-left mb-4 checkout-product-list">
                            <thead>
                                <tr>
                                    <th class="py-2 dark:text-white">Image</th>
                                    <th class="py-2 dark:text-white">Product</th>
                                    <th class="py-2 dark:text-white">Quantity</th>
                                    <th class="py-2 dark:text-white">Price</th>
                                    <th class="py-2 dark:text-white">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subtotal = 0; @endphp
                                @foreach($products as $product)
                                    @php $lineTotal = $product->price * $cart[$product->id]; $subtotal += $lineTotal; @endphp
                                    <tr>
                                        <td class="py-2">
                                            @if($product->image)
                                                <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-contain rounded">
                                            @endif
                                        </td>
                                        <td class="py-2 dark:text-white">{{ $product->name }}</td>
                                        <td class="py-2 dark:text-white">{{ $cart[$product->id] }}</td>
                                        <td class="py-2 dark:text-white">{{ $product->price }} €</td>
                                        <td class="py-2 dark:text-white">{{ number_format($lineTotal, 2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Sticky Total Summary -->
                    <div class="sticky bottom-0 bg-white dark:bg-gray-800 py-4 border-t border-gray-200 dark:border-gray-700 mt-2">
                        <p class="text-[#1b1b18] dark:text-white">Subtotal: <strong>{{ number_format($subtotal, 2) }} €</strong></p>
                        <p class="text-[#1b1b18] dark:text-white">Shipping: <strong>0.00 €</strong></p>
                        <p class="text-[#1b1b18] dark:text-white text-lg">Total: <strong>{{ number_format($subtotal, 2) }} €</strong></p>
                    </div>
                @else
                    <p class="text-gray-500">No products in cart.</p>
                @endif
            </div>
        </div>
        <footer class="text-center text-sm text-gray-500 mt-10">
            © 2025 3ELLLE. All rights reserved. |
            <a href="{{ url('/policies/privacy') }}" class="text-blue-500 hover:underline">Privacy Policy</a> |
            <a href="{{ url('/policies/terms') }}" class="text-blue-500 hover:underline">Terms of Service</a>
        </footer>
    </div>
    <style>
        .dark .checkout-product-list th,
        .dark .checkout-product-list td {
            color: #fff !important;
        }
        .dark .checkout-product-list tbody tr td {
            color: #fff !important;
        }
        .dark .checkout-product-list td .text-[#1b1b18] {
            color: #fff !important;
        }
    </style>
</x-app-layout>
