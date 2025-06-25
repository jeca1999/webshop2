@extends('layouts.app')

@section('content')
    <header class="w-full px-2 sm:px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
        <a href="{{ secure_url('/') }}" class="text-3xl font-bold text-center md:text-left text-black dark:text-white">3ELLLE</a>
        <div class="relative">
            <button id="profile-dropdown-toggle" class="flex items-center gap-2 px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:bg-blue-500 hover:text-white transition focus:outline-none">
                <span>Account</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
            <div id="profile-dropdown-menu" class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded shadow-lg z-50 hidden">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Edit Profile</a>
                <form method="POST" action="{{ secure_url('logout') }}">
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(!empty($cart) && count($products))
                        <form id="cart-form">
                        <table class="w-full text-left">
                            <thead>
                                <tr>
                                    <th class="py-2"><input type="checkbox" id="select-all"></th>
                                    <th class="py-2">Image</th>
                                    <th class="py-2">Product</th>
                                    <th class="py-2">Quantity</th>
                                    <th class="py-2">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="py-2">
                                            <input type="checkbox" class="product-checkbox" name="selected[]" value="{{ $product->id }}" data-price="{{ $product->price }}" data-qty="{{ $cart[$product->id] }}">
                                        </td>
                                        <td class="py-2">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-contain rounded">
                                            @endif
                                        </td>
                                        <td class="py-2">{{ $product->name }}</td>
                                        <td class="py-2">{{ $cart[$product->id] }}</td>
                                        <td class="py-2">{{ $product->price }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </form>
                        <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded flex flex-col gap-2">
                            <span><span id="selected-count">0</span> product(s) selected.</span>
                            <span>Total: <span id="selected-total">0.00</span> €</span>
                            <div class="flex gap-2 mt-2">
                                <button type="button" id="remove-selected" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Remove Selected</button>
                                <button type="button" id="checkout-selected" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Checkout Selected</button>
                            </div>
                        </div>
                        <form id="remove-form" method="POST" action="{{ url('/cart/remove', [], true) }}" style="display:none;">
                            @csrf
                            <input type="hidden" name="selected_ids" id="remove-ids">
                        </form>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const checkboxes = document.querySelectorAll('.product-checkbox');
                            const selectAll = document.getElementById('select-all');
                            const totalSpan = document.getElementById('selected-total');
                            const countSpan = document.getElementById('selected-count');
                            function updateTotal() {
                                let total = 0;
                                let count = 0;
                                checkboxes.forEach(cb => {
                                    if (cb.checked) {
                                        total += parseFloat(cb.dataset.price) * parseInt(cb.dataset.qty);
                                        count++;
                                    }
                                });
                                totalSpan.textContent = total.toFixed(2);
                                countSpan.textContent = count;
                            }
                            checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
                            selectAll.addEventListener('change', function() {
                                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                                updateTotal();
                            });
                            document.getElementById('remove-selected').onclick = function() {
                                const selected = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
                                if (selected.length === 0) return alert('Select at least one product.');
                                document.getElementById('remove-ids').value = selected.join(',');
                                document.getElementById('remove-form').submit();
                            };
                            document.getElementById('checkout-selected').onclick = function() {
                                const selected = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
                                if (selected.length === 0) return alert('Select at least one product.');
                                // Redirect to checkout page with selected_ids as GET param
                                window.location.href = '/profile/check-out?selected_ids=' + selected.join(',');
                            };
                        });
                        </script>
                    @else
                        {{ __("Your cart is currently empty.") }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    <style>
      @media (max-width: 640px) {
        .rounded-lg, .rounded { border-radius: 0.75rem !important; }
        .p-4, .p-6, .p-8 { padding: 1rem !important; }
      }
      @media (max-width: 400px) {
        .text-xl, .text-2xl, .text-4xl, .text-5xl { font-size: 1.1rem !important; }
        .font-bold { font-weight: 600 !important; }
      }
      .glow-blue { box-shadow: 0 0 8px 2px #3b82f6, 0 0 16px 4px #3b82f6; }
      .glow-x { box-shadow: 0 0 8px 2px #000, 0 0 16px 4px #000; }
      .glow-instagram { box-shadow: 0 0 8px 2px #ec4899, 0 0 16px 4px #ec4899; }
      .glow-tumblr { box-shadow: 0 0 8px 2px #1a365d, 0 0 16px 4px #1a365d; }
    </style>
    @endpush
    <script>
    (function() {
        const dropdownToggle = document.getElementById('profile-dropdown-toggle');
        const dropdownMenu = document.getElementById('profile-dropdown-menu');
        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });
            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
            document.addEventListener('click', function(e) {
                if (!dropdownMenu.classList.contains('hidden')) {
                    if (!dropdownMenu.contains(e.target) && !dropdownToggle.contains(e.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                }
            });
        }
    })();
    </script>
@endsection
