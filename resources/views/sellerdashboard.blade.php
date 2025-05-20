<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center text-4xl" >
                    {{ __("Welcome Back!") }}
                </div>
         

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js/dist/Chart.min.css">
@endpush

<div class="container mx-auto px-4 py-8">
    <!-- Dashboard Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col items-center">
            <span class="text-gray-500 dark:text-gray-300">Total Sales</span>
            <span class="text-2xl font-bold mt-2">$12,340</span>
        </div>
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col items-center">
            <span class="text-gray-500 dark:text-gray-300">Total Orders</span>
            <span class="text-2xl font-bold mt-2">320</span>
        </div>
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col items-center">
            <span class="text-gray-500 dark:text-gray-300">Pending Shipments</span>
            <span class="text-2xl font-bold mt-2">8</span>
        </div>
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col items-center">
            <span class="text-gray-500 dark:text-gray-300">Low Stock</span>
            <span class="text-2xl font-bold mt-2">3</span>
        </div>
    </div>

    <!-- Monthly Revenue Graph -->
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Monthly Revenue</h3>
        <canvas id="revenueChart" height="80"></canvas>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Product Management -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Products</h3>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Product</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Image</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Stock</th>
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row -->
                        <tr>
                            <td class="px-4 py-2"><img src="https://via.placeholder.com/40" class="rounded" alt="Product"></td>
                            <td class="px-4 py-2">Product A</td>
                            <td class="px-4 py-2">5</td>
                            <td class="px-4 py-2">Electronics</td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:underline">Edit</button>
                                <button class="text-red-600 hover:underline ml-2">Delete</button>
                            </td>
                        </tr>
                        <!-- More rows... -->
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-gray-700 dark:text-gray-300">Upload Images</label>
                <div class="border-2 border-dashed rounded p-4 text-center cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600">
                    <span class="text-gray-500 dark:text-gray-400">Drag & drop images here or click to upload</span>
                    <input type="file" class="hidden" multiple>
                </div>
            </div>
        </div>

        <!-- Order Management -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Orders</h3>
            <div class="flex space-x-2 mb-4">
                <button class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200">New</button>
                <button class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200">Processing</button>
                <button class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200">Completed</button>
                <button class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200">Cancelled</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Order #</th>
                            <th class="px-4 py-2">Customer</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row -->
                        <tr>
                            <td class="px-4 py-2">#1234</td>
                            <td class="px-4 py-2">Jane Doe</td>
                            <td class="px-4 py-2">New</td>
                            <td class="px-4 py-2">$120.00</td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:underline">View</button>
                                <button class="text-green-600 hover:underline ml-2">Mark as Shipped</button>
                            </td>
                        </tr>
                        <!-- More rows... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sales & Analytics -->
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Sales & Analytics</h3>
            <div>
                <input type="date" class="border rounded px-2 py-1 mr-2">
                <input type="date" class="border rounded px-2 py-1 mr-2">
                <select class="border rounded px-2 py-1">
                    <option>All Products</option>
                    <option>Product A</option>
                </select>
                <button class="bg-blue-600 text-white px-3 py-1 rounded ml-2">Export CSV</button>
                <button class="bg-gray-600 text-white px-3 py-1 rounded ml-2">Export PDF</button>
            </div>
        </div>
        <canvas id="salesChart" height="80"></canvas>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Messaging / Notifications -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Notifications</h3>
            <ul>
                <li class="mb-2 text-gray-700 dark:text-gray-300">Order #1234 has been shipped.</li>
                <li class="mb-2 text-gray-700 dark:text-gray-300">Stock low for Product A.</li>
                <li class="mb-2 text-gray-700 dark:text-gray-300">New message from John Smith.</li>
            </ul>
        </div>

        <!-- Customer Management -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Customers</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Orders</th>
                            <th class="px-4 py-2">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2">Jane Doe</td>
                            <td class="px-4 py-2">jane@example.com</td>
                            <td class="px-4 py-2">5</td>
                            <td class="px-4 py-2"><button class="text-blue-600 hover:underline">Add Note</button></td>
                        </tr>
                        <!-- More rows... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Payment & Payout Tracking -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Payouts</h3>
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-700 dark:text-gray-300">Total Earnings</span>
                <span class="font-bold">$10,000</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-700 dark:text-gray-300">Pending Payouts</span>
                <span class="font-bold">$1,200</span>
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Download Invoice</button>
        </div>

        <!-- Review & Rating Management -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Reviews</h3>
            <ul>
                <li class="mb-4">
                    <div class="flex items-center">
                        <span class="font-bold mr-2">Jane Doe</span>
                        <span class="text-yellow-500">★★★★☆</span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">Great product, fast shipping!</p>
                    <div class="flex space-x-2 mt-2">
                        <button class="text-blue-600 hover:underline">Reply</button>
                        <button class="text-red-600 hover:underline">Report</button>
                    </div>
                </li>
                <!-- More reviews... -->
            </ul>
        </div>
    </div>

    <!-- Settings & Profile -->
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Settings & Profile</h3>
        <form class="space-y-4">
            <div>
                <label class="block mb-1 text-gray-700 dark:text-gray-300">Shop Name</label>
                <input type="text" class="w-full border rounded px-3 py-2" value="My Shop">
            </div>
            <div>
                <label class="block mb-1 text-gray-700 dark:text-gray-300">Banner/Logo</label>
                <input type="file" class="w-full">
            </div>
            <div>
                <label class="block mb-1 text-gray-700 dark:text-gray-300">Shipping Options</label>
                <input type="text" class="w-full border rounded px-3 py-2" value="Standard, Express">
            </div>
            <div>
                <label class="block mb-1 text-gray-700 dark:text-gray-300">Tax Policy</label>
                <textarea class="w-full border rounded px-3 py-2">Standard VAT applies.</textarea>
            </div>
            <div>
                <label class="block mb-1 text-gray-700 dark:text-gray-300">Return Policy</label>
                <textarea class="w-full border rounded px-3 py-2">Returns accepted within 30 days.</textarea>
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Save Changes</button>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Revenue Chart
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue',
                data: [1200, 1900, 3000, 2500, 3200, 4000],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    // Sales Chart
    const ctxSales = document.getElementById('salesChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: ['Product A', 'Product B', 'Product C'],
            datasets: [{
                label: 'Sales',
                data: [120, 90, 60],
                backgroundColor: ['#2563eb', '#10b981', '#f59e42']
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endpush
</x-app-layout>
   </div>
        </div>
    