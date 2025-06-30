<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SellerProductController extends Controller
{
    public function manage()
    {
        $products = Product::where('seller_id', auth('seller')->id())->get();
        return view('seller.products', compact('products'));
    }

    public function updateStock(Request $request, $productId)
    {
        $request->validate([
            'stock_status' => 'required|in:available,low,sold_out',
        ]);
        $product = Product::where('seller_id', auth('seller')->id())->findOrFail($productId);
        $product->stock_status = $request->stock_status;
        $product->save();
        return back()->with('success', 'Stock status updated!');
    }
}
