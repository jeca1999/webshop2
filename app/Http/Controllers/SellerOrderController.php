<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class SellerOrderController extends Controller
{
    public function notifications()
    {
        // Get all orders and filter in PHP for products owned by this seller
        $sellerId = auth('seller')->id();
        $orders = Order::all()->filter(function($order) use ($sellerId) {
            if (!is_array($order->products)) return false;
            foreach ($order->products as $p) {
                if (isset($p['id'])) {
                    $prod = Product::find($p['id']);
                    if ($prod && $prod->seller_id == $sellerId) return true;
                }
            }
            return false;
        });
        // Attach product and user for each order (first product for this seller)
        $orders = $orders->map(function($order) use ($sellerId) {
            if (!is_array($order->products)) return $order;
            foreach ($order->products as $p) {
                if (isset($p['id'])) {
                    $prod = Product::find($p['id']);
                    if ($prod && $prod->seller_id == $sellerId) {
                        $order->product = $prod;
                        break;
                    }
                }
            }
            $order->user = $order->user;
            return $order;
        });
        return view('seller.notifications', compact('orders'));
    }

    public function updateStatus(Request $request, $orderId)
    {
        $request->validate(['status' => 'required|in:received,shipped']);
        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();
        return back()->with('success', 'Order status updated!');
    }
}
