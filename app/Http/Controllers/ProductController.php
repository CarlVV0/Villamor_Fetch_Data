<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    // Get all products
    public function index(Request $request)
    {
        $products = Product::all();

        // Check if request expects JSON (for API) or Inertia response (for web)
        if ($request->wantsJson()) {
            return response()->json($products);
        }

        return Inertia::render('Products', ['products' => $products]);
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|url',
            'description' => 'required|string',
        ]);

        $product = Product::create($request->all());

        // If request expects JSON (API), return JSON response
        if ($request->wantsJson()) {
            return response()->json($product, 201);
        }

        // Otherwise, redirect back to products list with success message
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
}
