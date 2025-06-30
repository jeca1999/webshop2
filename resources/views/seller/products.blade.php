@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Manage Products</h1>
    @if($products->isEmpty())
        <div class="text-gray-500">No products found.</div>
    @else
        <div class="space-y-6">
            @foreach($products as $product)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-4 flex flex-col gap-4">
                    <div class="modal-content w-full max-w-lg mx-auto flex flex-col items-center">
                        @if($product->image ?? false)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full max-w-xs h-auto aspect-square object-contain rounded border border-gray-200 dark:border-gray-700 bg-white mb-4" />
                        @else
                            <div class="w-full max-w-xs aspect-square flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 text-gray-400 text-2xl mb-4">No Image</div>
                        @endif
                        <div class="w-full">
                            <div class="font-semibold text-lg text-center mb-2">{{ $product->name }}</div>
                            <div class="text-center mb-2">Current Stock: {{ $product->stock ?? 'N/A' }}</div>
                            <div class="text-center mb-4">Status: <span class="font-bold">{{ ucfirst($product->stock_status ?? 'available') }}</span></div>
                            <form method="POST" action="{{ route('seller.products.updateStock', $product->id) }}" class="flex flex-col md:flex-row gap-2 items-center justify-center">
                                @csrf
                                @method('PATCH')
                                <select name="stock_status" class="border rounded p-2">
                                    <option value="available" @if(($product->stock_status ?? 'available')=='available') selected @endif>Available</option>
                                    <option value="low" @if(($product->stock_status ?? '')=='low') selected @endif>Low on Stock</option>
                                    <option value="sold_out" @if(($product->stock_status ?? '')=='sold_out') selected @endif>Sold Out</option>
                                </select>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
