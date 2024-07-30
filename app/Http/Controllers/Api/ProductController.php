<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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
    public function store(StoreProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();

                if ($request->hasFile('productImage')) {
                    $imagePath = $request->file('productImage')->store('productImage', 'public');
                    $data['productImage'] = $imagePath;
                }

                $product = Product::create($data);

                return response()->json([
                    'message' => 'Product created successfully',
                    'data' => new ProductResource($product)
                ], 201);
            });
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
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {
                $data = $request->validated();

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
            });
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
            DB::transaction(function () use ($product) {
                $product->delete();

                return response()->json([
                    'message' => 'Product deleted successfully'
                ], 200);
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
