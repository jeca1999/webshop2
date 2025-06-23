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
                        <ul class="space-y-2 mb-6">
                            <li><a href="{{ url('/support/find-order') }}" class="text-red-600 hover:underline">Find my order</a></li>
                            <li><a href="{{ url('/support/returns-refunds') }}" class="text-red-600 hover:underline">Returns and refunds</a></li>
                            <li><a href="{{ url('/policies/privacy-policy') }}" class="text-red-600 hover:underline">Privacy Policy</a></li>
                            <li><a href="{{ url('/policies/terms-of-service') }}" class="text-red-600 hover:underline">Terms of Service</a></li>
                        </ul>
                        <div class="mt-4" x-data="{ highlightX: false, highlightInstagram: false, highlightTumblr: false, highlightFacebook: false }">
                            <h4 class="font-semibold mb-2">Contact Support</h4>
                            <div class="flex gap-4">
                                <a href="https://x.com/straw_zellieace?t=S2p6w7ZRz0nzI_ZuMtaVZg&s=09" target="_blank" title="X (Twitter)" class="hover:text-red-500 glow-x"
                                   :class="highlightX ? 'ring-2 ring-black' : ''"
                                   @mouseenter="highlightX = true" @mouseleave="highlightX = false" @focus="highlightX = true" @blur="highlightX = false" tabindex="0">
                                    <!-- X SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M22.162 2.667h-4.326l-4.162 5.667-4.162-5.667h-4.326l6.488 8.833-6.488 8.833h4.326l4.162-5.667 4.162 5.667h4.326l-6.488-8.833z"/></svg>
                                </a>
                                <a href="https://www.instagram.com/strawzellieace?igsh=MTQxb3RqeXZvOHd5Nw==" target="_blank" title="Instagram" class="hover:text-red-500 glow-instagram"
                                   :class="highlightInstagram ? 'ring-2 ring-pink-400' : ''"
                                   @mouseenter="highlightInstagram = true" @mouseleave="highlightInstagram = false" @focus="highlightInstagram = true" @blur="highlightInstagram = false" tabindex="0">
                                    <!-- Instagram SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.974.974 1.246 2.241 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.974.974-2.241 1.246-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.974-.974-1.246-2.241-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.334-2.633 1.308-3.608.974-.974 2.241-1.246 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.012-4.947.07-1.276.058-2.687.334-3.662 1.308-.974.974-1.25 2.386-1.308 3.662-.058 1.28-.07 1.688-.07 4.947s.012 3.667.07 4.947c.058 1.276.334 2.687 1.308 3.662.974.974 2.386 1.25 3.662 1.308 1.28.058 1.688.07 4.947.07s3.667-.012 4.947-.07c1.276-.058 2.687-.334 3.662-1.308.974-.974 1.25-2.386 1.308-3.662.058-1.28.07-1.688.07-4.947s-.012-3.667-.07-4.947c-.058-1.276-.334-2.687-1.308-3.662-.974-.974-2.386-1.25-3.662-1.308-1.28-.058-1.688-.07-4.947-.07z"/><circle cx="12" cy="12" r="3.5"/></svg>
                                </a>
                                <a href="https://www.tumblr.com/strawzellieace?source=share" target="_blank" title="Tumblr" class="hover:text-red-500 glow-tumblr"
                                   :class="highlightTumblr ? 'ring-2 ring-blue-700' : ''"
                                   @mouseenter="highlightTumblr = true" @mouseleave="highlightTumblr = false" @focus="highlightTumblr = true" @blur="highlightTumblr = false" tabindex="0">
                                    <!-- Tumblr SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.39 20.29c-.31.15-.6.28-.87.39-.27.11-.56.2-.87.27-.31.07-.66.11-1.05.11-.44 0-.84-.06-1.2-.18-.36-.12-.67-.3-.92-.54-.25-.24-.44-.54-.57-.9-.13-.36-.19-.8-.19-1.31v-5.36h3.13v-2.36h-3.13v-2.41c0-.36.04-.66.13-.89.09-.23.22-.41.39-.54.17-.13.38-.22.62-.27.24-.05.51-.08.81-.08.23 0 .45.01.66.03.21.02.41.05.6.09.19.04.36.09.52.15.16.06.3.13.43.21v-2.36c-.29-.08-.6-.14-.93-.18-.33-.04-.7-.06-1.12-.06-.56 0-1.09.07-1.59.2-.5.13-.94.34-1.32.62-.38.28-.68.65-.9 1.1-.22.45-.33 1.01-.33 1.68v2.41h-1.7v2.36h1.7v5.36c0 .77.11 1.45.33 2.03.22.58.54 1.08.97 1.5.43.42.97.74 1.62.97.65.23 1.41.34 2.29.34.56 0 1.09-.05 1.59-.16.5-.11.97-.27 1.41-.48v-2.18z"/></svg>
                                </a>
                                <a href="https://www.facebook.com/share/1B2KpFju7d/" target="_blank" title="Facebook" class="hover:text-red-500 glow-blue"
                                   :class="highlightFacebook ? 'ring-2 ring-blue-400' : ''"
                                   @mouseenter="highlightFacebook = true" @mouseleave="highlightFacebook = false" @focus="highlightFacebook = true" @blur="highlightFacebook = false" tabindex="0">
                                    <!-- Facebook SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/></svg>
                                </a>
                            </div>
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
      .glow-blue { box-shadow: 0 0 8px 2px #3b82f6, 0 0 16px 4px #3b82f6; }
      .glow-x { box-shadow: 0 0 8px 2px #000, 0 0 16px 4px #000; }
      .glow-instagram { box-shadow: 0 0 8px 2px #ec4899, 0 0 16px 4px #ec4899; }
      .glow-tumblr { box-shadow: 0 0 8px 2px #1a365d, 0 0 16px 4px #1a365d; }
    </style>
    @endpush
</x-app-layout>
