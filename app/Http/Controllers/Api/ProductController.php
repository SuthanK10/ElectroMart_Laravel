<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = \Illuminate\Support\Facades\Cache::remember('products_page_' . request('page', 1), 60, function () {
            return Product::active()->with('category')->paginate(10);
        });
        
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        // Admin authorization check (managed by middleware in routes, but good to have here too)
        if (!Auth::user()?->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated);

        return new ProductResource($product);
    }
}
