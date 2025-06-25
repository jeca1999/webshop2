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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                @if($orders && count($orders))
                    @foreach($orders as $order)
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-2">
                                <div>
                                    <div class="font-bold text-lg dark:text-white">Order #{{ $order->id }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-300">Order Code: <span class="font-mono">{{ $order->order_code }}</span></div>
                                </div>
                                <div class="text-sm text-gray-500 dark:text-white">Placed: {{ $order->created_at->format('Y-m-d H:i') }}</div>
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold dark:text-white ">Products:</span>
                                <ul class="list-disc ml-6 mt-1 dark:text-gray-200">
                                    @foreach($order->products as $product)
                                        <li class="mb-1">
                                            <span class="font-medium dark:text-white">{{ $product['name'] ?? 'Product' }}</span>
                                            <span class="text-xs text-gray-500">x{{ $product['qty'] ?? 1 }}</span>
                                            <span class="text-xs text-gray-400">@ ${{ number_format($product['price'] ?? 0, 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <span class="font-semibold dark:text-white">Payment Mode:</span>
                                    <div class="text-gray-700 dark:text-gray-200">{{ $order->mode_of_payment }}</div>
                                </div>
                                <div>
                                    <span class="font-semibold dark:text-white">Address:</span>
                                    <div class="text-gray-700 dark:text-gray-200">{{ $order->address }}</div>
                                </div>
                                <div>
                                    <span class="font-semibold dark:text-white">Status:</span>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                        $status = strtolower($order->status);
                                        $badgeClass = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                        {{ __("You have no orders yet.") }}
                    </div>
                @endif
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
