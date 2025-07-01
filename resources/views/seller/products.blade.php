<x-app-layout>
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
