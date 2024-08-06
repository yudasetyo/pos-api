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
            // Validate the request data
            $data = $request->validated();

            // Handle the database transaction
            $response = DB::transaction(function () use ($request, $data) {
                // Process the product image if it exists
                if ($request->hasFile('productImage')) {
                    $imagePath = $request->file('productImage')->store('productImage', 'public');
                    $data['productImage'] = $imagePath;
                }
    
                // Create the product record
                $product = Product::create($data);
    
                // Return a successful response with the product resource
                return response()->json([
                    'message' => 'Product created successfully',
                    'data' => new ProductResource($product)
                ], 201);
            });
    
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
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
            // Validate the request data
            $data = $request->validated();

            // Handle the database transaction
            $response = DB::transaction(function () use ($request, $data, $product) {
                // Check if a new product image is uploaded
                if ($request->hasFile('productImage')) {
                    // Delete the old image if it exists
                    if ($product->productImage) {
                        Storage::disk('public')->delete($product->productImage);
                    }

                    // Store the new image
                    $imagePath = $request->file('productImage')->store('productImage', 'public');
                    $data['productImage'] = $imagePath;
                }

                // Update the product record with the new data
                $product->update($data);

                // Return a successful response with the updated product resource
                return response()->json([
                    'message' => 'Product updated successfully',
                    'data' => new ProductResource($product)
                ], 200);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
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
            // Handle the database transaction
            $response = DB::transaction(function () use ($product) {
                // Delete the product
                $product->delete();

                // Return a successful response
                return response()->json([
                    'message' => 'Product deleted successfully'
                ], 200);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
            return response()->json([
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
