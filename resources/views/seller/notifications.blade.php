
<x-app-layout>
    <div>
        <!-- Header -->
        <header class="w-full px-2 sm:px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
            <a href="{{ secure_url('/') }}" class="text-3xl font-bold text-center md:text-left text-black dark:text-white">3ELLLE</a>
            <div class="relative">
                <button id="profile-dropdown-toggle" class="flex items-center gap-2 px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:bg-blue-500 hover:text-white transition focus:outline-none">
                    <span>Account</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div id="profile-dropdown-menu" class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded shadow-lg z-50 hidden">
                    <a href="{{ route('seller.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Edit Profile</a>
                    <form method="POST" action="{{ secure_url('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Logout</button>
                    </form>
                </div>
            </div>
        </header>
        <script>
        // Attach dropdown logic immediately after header
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

        <nav class="w-full flex gap-4 flex-wrap justify-center mt-4 mb-8">
            <a href="{{ route('seller.dashboard') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Dashboard</a>
            <a href="{{ route('seller.products') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Products</a>
            <a href="{{ route('seller.orders.notifications') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Orders</a>
        </nav>

        <div class="max-w-3xl mx-auto p-4 flex justify-center items-center min-h-[60vh]">
            <div class="w-full bg-white/80 dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 rounded-lg shadow p-6 flex flex-col items-center">
                <h1 class="text-2xl font-bold mb-6 text-center">Order Notifications</h1>
                @if($orders->isEmpty())
                    <div class="text-gray-500 text-center">No new orders yet.</div>
                @else
                    <div class="space-y-6 w-full">
                        @foreach($orders as $order)
                            <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-4 flex flex-col md:flex-row md:items-center md:justify-between border border-gray-100 dark:border-gray-800">
                                <div class="mb-2 md:mb-0">
                                    <div class="font-semibold">Client: {{ $order->user->name }}</div>
                                    <div>Product: {{ $order->product->name }}</div>
                                    <div>Status: <span class="font-bold">{{ ucfirst($order->status) }}</span></div>
                                </div>
                                <form method="POST" action="{{ route('seller.orders.updateStatus', $order->id) }}" class="mt-4 md:mt-0 flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="border rounded p-2">
                                        <option value="received" @if($order->status=='received') selected @endif>Received</option>
                                        <option value="shipped" @if($order->status=='shipped') selected @endif>Shipped</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
