@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Order Notifications</h1>
    @if($orders->isEmpty())
        <div class="text-gray-500">No new orders yet.</div>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-4 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
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
@endsection
