<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderNotification;
use App\Models\Seller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = [];
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::id())->latest()->get();
        }
        return view('orders', compact('orders'));
    }

    public function cancel(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->firstOrFail();
        $sellerId = $order->seller_id ?? null;
        $order->delete();

        // Notify seller
        if ($sellerId) {
            OrderNotification::create([
                'order_id' => $orderId,
                'seller_id' => $sellerId,
                'message' => 'Order #' . $orderId . ' was cancelled by the client.',
                'type' => 'cancelled',
            ]);
        }

        return redirect()->route('orders')->with('status', 'Order cancelled successfully.');
    }
}
