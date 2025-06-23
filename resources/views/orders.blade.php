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
    <style>
        .dark .bg-white {
            background-color: #1f2937 !important;
        }
        .dark .text-gray-800,
        .dark .text-gray-700,
        .dark .text-gray-500,
        .dark .text-gray-400,
        .dark .font-bold,
        .dark .font-medium,
        .dark .font-semibold,
        .dark .text-lg,
        .dark .text-sm,
        .dark .text-xs,
        .dark .text-center,
        .dark .text-left,
        .dark .text-right,
        .dark span,
        .dark div,
        .dark li,
        .dark ul,
        .dark h2 {
            color: #fff !important;
        }
        .dark .border-gray-200 {
            border-color: #374151 !important;
        }
        .dark .bg-yellow-100 { background-color: #b45309 !important; color: #fff !important; }
        .dark .bg-green-100 { background-color: #047857 !important; color: #fff !important; }
        .dark .bg-red-100 { background-color: #b91c1c !important; color: #fff !important; }
        .dark .bg-gray-100 { background-color: #374151 !important; color: #fff !important; }
        .dark .text-yellow-800,
        .dark .text-green-800,
        .dark .text-red-800,
        .dark .text-gray-800 {
            color: #fff !important;
        }
        .dark span.font-semibold {
            color: #fff !important;
        }
    </style>
</x-app-layout>
