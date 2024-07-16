<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'productName' => ['required', 'string', 'max:255'],
                'productImage' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
                'productDescription' => ['required', 'string', 'max:65535'],
                'productPrice' => ['required', 'integer', 'min:3'],
            ]);

            if ($request->hasFile('productImage')) {
                $imagePath = $request->file('productImage')->store('productImage', 'public');
                $data['productImage'] = $imagePath;
            }

            $product = Product::create($data);

            return response()->json([
                'message' => 'Product created successfully',
                'data' => new ProductResource($product)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create product',
                'error' =>  $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $data = $request->validate([
                'productName' => ['sometimes', 'string', 'max:255'],
                'productImage' => ['sometimes', 'nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
                'productDescription' => ['sometimes', 'string', 'max:65535'],
                'productPrice' => ['required', 'number', 'max:100'],
            ]);

            if ($request->hasFile('productImage')) {
                if ($product->productImage) {
                    Storage::disk('public')->delete($product->productImage);
                }

                $imagePath = $request->file('productImage')->store('productImage', 'public');
                $data['productImage'] = $imagePath;
            }

            $product->update($data);

            return response()->json([
                'message' => 'Product updated successfully',
                'data' => new ProductResource($product)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return response()->json([
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
