@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Manage Products</h1>
    @if($products->isEmpty())
        <div class="text-gray-500">No products found.</div>
    @else
        <div class="space-y-6">
            @foreach($products as $product)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-4 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div>Current Stock: {{ $product->stock ?? 'N/A' }}</div>
                        <div>Status: <span class="font-bold">{{ ucfirst($product->stock_status ?? 'available') }}</span></div>
                    </div>
                    <form method="POST" action="{{ route('seller.products.updateStock', $product->id) }}" class="mt-4 md:mt-0 flex gap-2">
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
            @endforeach
        </div>
    @endif
</div>
@endsection
