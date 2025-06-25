<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight text-center">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>
    <h1 class="text-3xl font-bold text-red-500">Welcome to 3ELLLE</h1>
    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-sm rounded-lg">
                <div class="p-4 sm:p-6 md:p-8 text-black dark:text-white text-center text-2xl md:text-4xl">
                    {{ __("Welcome Back!") }}
                </div>
            </div>
            <div class="bg-white dark:bg-black overflow-hidden shadow-sm rounded-lg mt-8">
                <div class="p-4 sm:p-6 md:p-8 text-black dark:text-white grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    @php
                        $sellerId = auth('seller')->id();
                        $products = \App\Models\Product::where('seller_id', $sellerId)->get();

                        // Calculate total units sold for each product (all time)
                        $productIds = $products->pluck('id');
                        $orders = \App\Models\Order::whereNotNull('products')->get();
                        $unitsSoldMap = [];
                        foreach ($orders as $order) {
                            foreach ($order->products as $p) {
                                if (in_array($p['id'], $productIds->all())) {
                                    if (!isset($unitsSoldMap[$p['id']])) $unitsSoldMap[$p['id']] = 0;
                                    $unitsSoldMap[$p['id']] += $p['qty'];
                                }
                            }
                        }
                        $totalSales = 0;
                        $totalRevenue = 0;
                        $totalOrders = 0;
                        $productStats = [];
                        $chartLabels = [];
                        $chartData = [];
                        $now = now();
                        $startOfWeek = $now->copy()->startOfWeek();
                        $endOfWeek = $now->copy()->endOfWeek();
                        foreach ($products as $product) {
                            $unitsSold = $unitsSoldMap[$product->id] ?? 0;
                            $revenue = 0;
                            $weeklyRevenue = 0;
                            $productOrders = \App\Models\Order::whereJsonContains('products', [['id' => $product->id]])->whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
                            foreach ($productOrders as $order) {
                                foreach ($order->products as $p) {
                                    if ($p['id'] == $product->id) {
                                        $revenue += $p['qty'] * $p['price'];
                                        $weeklyRevenue += $p['qty'] * $p['price'];
                                    }
                                }
                            }
                            $productStats[] = [
                                'name' => $product->name,
                                'units_sold' => $unitsSold, // Use all-time units sold
                                'revenue' => $revenue
                            ];
                            $chartLabels[] = $product->name;
                            $chartData[] = $unitsSold; // Show all-time units sold in the bar chart
                            $totalSales += $unitsSold;
                            $totalRevenue += $revenue;
                        }
                        if (!isset($chartLabels)) $chartLabels = [];
                        if (!isset($chartData)) $chartData = [];
                        $totalOrders = \App\Models\Order::whereJsonContains('products', [['id' => $products->pluck('id')->toArray()]])->count();
                    @endphp
                    <div class="col-span-1 flex flex-col gap-4">
                        <div class="bg-red-100 dark:bg-red-900 p-4 rounded shadow text-center">
                            <div class="text-2xl font-bold text-black dark:text-white">{{ $totalSales }}</div>
                            <div class="text-black dark:text-white">Total Units Sold</div>
                        </div>
                        <div class="bg-white dark:bg-black border border-red-500 p-4 rounded shadow text-center">
                            <div class="text-2xl font-bold text-black dark:text-white">₱{{ number_format($totalRevenue, 2) }}</div>
                            <div class="text-black dark:text-white">Total Revenue</div>
                        </div>
                        <div class="bg-white dark:bg-black border border-red-500 p-4 rounded shadow text-center">
                            <div class="text-2xl font-bold text-black dark:text-white">{{ $totalOrders }}</div>
                            <div class="text-black dark:text-white">Total Orders</div>
                        </div>
                    </div>
                    <div class="col-span-2 flex flex-col gap-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm md:text-base">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-2 text-left">Product</th>
                                        <th class="px-2 py-2 text-left">Units Sold</th>
                                        <th class="px-2 py-2 text-left">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productStats as $stat)
                                        <tr>
                                            <td class="px-2 py-2">{{ $stat['name'] }}</td>
                                            <td class="px-2 py-2">{{ $stat['units_sold'] }}</td>
                                            <td class="px-2 py-2">₱{{ number_format($stat['revenue'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="w-full">
                            <canvas id="salesChart" class="w-full h-48 md:h-64"></canvas>
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
        .text-2xl, .text-4xl { font-size: 1.2rem !important; }
        .text-center { text-align: center !important; }
      }
      @media (max-width: 400px) {
        .text-xl, .text-2xl, .text-4xl, .text-5xl { font-size: 1.1rem !important; }
        .font-bold { font-weight: 600 !important; }
        table { font-size: 0.9rem !important; }
      }
    </style>
    @endpush
    @push('scripts')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: @json($chartLabels),
            datasets: [{
              label: 'Units Sold',
              data: @json($chartData),
              backgroundColor: 'rgba(239, 68, 68, 0.7)',
              borderColor: 'rgba(239, 68, 68, 1)',
              borderWidth: 1,
              borderRadius: 6,
              maxBarThickness: 48
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false },
              title: { display: false }
            },
            scales: {
              x: { grid: { display: false }, ticks: { color: '#222', font: { weight: 'bold' } } },
              y: { beginAtZero: true, grid: { color: '#eee' }, ticks: { color: '#222' } }
            }
          }
        });
      });
    </script>
    @endpush
</x-app-layout>
