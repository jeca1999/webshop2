<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', auth('seller')->id())->get();
        return view('products', compact('products'));
    }

    public function store(Request $request)
    {
        if (!auth('seller')->check()) {
            return redirect()->route('seller.products')->with('error', 'You must be logged in as a seller to add a product.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'size' => 'required|string|max:255',
            'category' => 'required|in:shop,prototype,comissions',
            'subcategory' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $valid = [
                        'shop' => ['paintings', 'sketches', 'digital arts'],
                        'prototype' => ['mats', 'pins'],
                        'comissions' => [],
                    ];
                    $cat = $request->category;
                    if (!isset($valid[$cat]) || !in_array($value, $valid[$cat])) {
                        $fail('Invalid subcategory for the selected category.');
                    }
                }
            ],
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'size' => $request->size,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'image' => $imagePath, // Always set image field
            'seller_id' => auth('seller')->id(),
            'is_approved' => true, // Automatically approve products uploaded by sellers
        ]);

        return redirect()->route('seller.products')->with('success', 'Product added successfully!');
    }

    public function destroy(Product $product)
    {
        // Only allow the seller who owns the product to delete
        if ($product->seller_id !== auth('seller')->id()) {
            return redirect()->route('seller.products')->with('error', 'Unauthorized action.');
        }
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('seller.products')->with('success', 'Product deleted successfully!');
    }

    public function update(Request $request, Product $product)
    {
        // Only allow the seller who owns the product to update
        if ($product->seller_id !== auth('seller')->id()) {
            return redirect()->route('seller.products')->with('error', 'Unauthorized action.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'size' => 'required|string|max:255',
            'category' => 'required|in:shop,prototype,comissions',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);
        $data = $request->only(['name', 'description', 'price', 'size', 'category']);
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);
        return redirect()->route('seller.products')->with('success', 'Product updated successfully!');
    }

    public function shop()
    {
        $products = Product::where('is_approved', true)
            ->orderBy('category')
            
            ->get()
            ->groupBy(function ($product) {
                return [
                    'category' => $product->category,
                    'subcategory' => $product->subcategory ?? 'Uncategorized',
                ];
            });

        return view('shop', compact('products'));
    }

    public function prototype()
    {
        $products = Product::where('is_approved', true)
            ->orderBy('category')
            
            ->get()
            ->groupBy(function ($product) {
                return [
                    'category' => $product->category,
                    'subcategory' => $product->subcategory ?? 'Uncategorized',
                ];
            });

        return view('prototype', compact('products'));
    }
}