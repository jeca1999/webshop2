<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                @if($orders && count($orders))
                    @foreach($orders as $order)
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-2">
                                <div class="font-bold text-lg">Order #{{ $order->id }}</div>
                                <div class="text-sm text-gray-500">Placed: {{ $order->created_at->format('Y-m-d H:i') }}</div>
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Products:</span>
                                <ul class="list-disc ml-6 mt-1">
                                    @foreach($order->products as $product)
                                        <li class="mb-1">
                                            <span class="font-medium">{{ $product['name'] ?? 'Product' }}</span>
                                            <span class="text-xs text-gray-500">x{{ $product['qty'] ?? 1 }}</span>
                                            <span class="text-xs text-gray-400">@ ${{ number_format($product['price'] ?? 0, 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <span class="font-semibold">Payment Mode:</span>
                                    <div class="text-gray-700 dark:text-gray-200">{{ $order->mode_of_payment }}</div>
                                </div>
                                <div>
                                    <span class="font-semibold">Address:</span>
                                    <div class="text-gray-700 dark:text-gray-200">{{ $order->address }}</div>
                                </div>
                                <div>
                                    <span class="font-semibold">Status:</span>
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
</x-app-layout>
