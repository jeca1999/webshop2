<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight text-center">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-sm rounded-lg">
                <div class="p-4 sm:p-6 md:p-8 text-black dark:text-white">
                    {{ __("Information") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <!-- Recent Orders -->
            <div class="md:col-span-2">
                <div class="bg-white dark:bg-black overflow-hidden shadow-sm rounded-lg mb-8">
                    <div class="p-4 sm:p-6 md:p-8 text-black dark:text-white">
                        <h3 class="text-xl font-bold mb-4">Recent Orders</h3>
                        @php
                            $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->take(3)->get();
                        @endphp
                        @if($orders->count())
                            <ul class="space-y-4">
                                @foreach($orders as $order)
                                    <li class="border-b border-gray-300 dark:border-gray-700 pb-2">
                                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-y-2">
                                            <span class="font-semibold">Order #{{ $order->id }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                                        </div>
                                        <div class="text-sm text-black dark:text-white mt-1 flex flex-wrap gap-x-2">
                                            @foreach($order->products as $product)
                                                <span>{{ $product['name'] ?? 'Product' }} x{{ $product['qty'] ?? 1 }}</span>@if(!$loop->last), @endif
                                            @endforeach
                                        </div>
                                        <div class="text-xs mt-1">
                                            <span class="font-semibold">Status:</span>
                                            <span class="inline-block px-2 py-1 rounded-full {{ strtolower($order->status) === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : (strtolower($order->status) === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-4 text-right">
                                <a href="{{ route('orders') }}" class="text-red-600 hover:underline">View all orders</a>
                            </div>
                        @else
                            <div class="text-gray-500 dark:text-gray-400">You have no orders yet.</div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Support/Help -->
            <div>
                <div class="bg-white dark:bg-black overflow-hidden shadow-sm rounded-lg h-full flex flex-col justify-between">
                    <div class="p-4 sm:p-6 md:p-8 text-black dark:text-white">
                        <h3 class="text-xl font-bold mb-4">Need Help?</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-red-600 hover:underline">Find my order</a></li>
                            <li><a href="#" class="text-red-600 hover:underline">Returns and refunds</a></li>
                            <li><a href="#" class="text-red-600 hover:underline">Privacy Policy</a></li>
                            <li><a href="#" class="text-red-600 hover:underline">Terms of Service</a></li>
                        </ul>
                        <div class="mt-6">
                            <a href="#" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Contact Support</a>
                        </div>
                    </div>
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
    </style>
    @endpush
</x-app-layout>
