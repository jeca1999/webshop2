<x-app-layout>
    <!-- Header copied from sellerdashboard.blade.php -->
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
        <a href="{{ route('seller.products.manage') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Manage Stock</a>
        <a href="{{ route('seller.products') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Products</a>
        <a href="{{ route('seller.orders.notifications') }}" class="inline-block px-8 py-3 text-lg font-semibold text-black dark:text-white rounded-md leading-normal transition hover:text-red-500 hover:drop-shadow-[0_0_8px_rgba(239,68,68,0.7)] focus:outline-none">Orders</a>
    </nav>
    <style>
    nav a:hover {
        color: #ef4444 !important; /* Tailwind red-500 */
        filter: drop-shadow(0 0 8px rgba(239,68,68,0.7));
        background: none !important;
    }
    </style>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6 text-center text-black dark:text-white">Manage Product Stock Status</h2>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow p-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm md:text-base">
                <thead>
                    <tr>
                        <th class="px-2 py-2 text-left">Product</th>
                        <th class="px-2 py-2 text-left">Current Status</th>
                        <th class="px-2 py-2 text-left">Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="px-2 py-2">{{ $product->name }}</td>
                            <td class="px-2 py-2">
                                @if($product->stock_status === 'sold_out')
                                    <span class="inline-block px-2 py-1 rounded-full bg-red-200 text-red-800">Sold Out</span>
                                @elseif($product->stock_status === 'low')
                                    <span class="inline-block px-2 py-1 rounded-full bg-yellow-200 text-yellow-800">Low</span>
                                @else
                                    <span class="inline-block px-2 py-1 rounded-full bg-green-200 text-green-800">Available</span>
                                @endif
                            </td>
                            <td class="px-2 py-2">
                                <form method="POST" action="{{ route('seller.products.updateStock', $product->id) }}" class="flex gap-2 items-center">
                                    @csrf
                                    @method('PATCH')
                                    <select name="stock_status" class="rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                                        <option value="available" @if($product->stock_status === 'available') selected @endif>Available</option>
                                        <option value="low" @if($product->stock_status === 'low') selected @endif>Low</option>
                                        <option value="sold_out" @if($product->stock_status === 'sold_out') selected @endif>Sold Out</option>
                                    </select>
                                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
