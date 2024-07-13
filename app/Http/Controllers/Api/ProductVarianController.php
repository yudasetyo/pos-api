<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariantResource;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productVariants = ProductVariant::latest()->paginate(10);
        return ProductVariantResource::collection($productVariants);
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
                'product_id' => ['required', 'integer'],
                'productName' => ['required', 'string', 'max:255'],
                'productPrice' => ['required', 'string', 'max:100'],
            ]);

            $productVariant = ProductVariant::create($data);

            return response()->json([
                'message' => 'Product Variant created successfully',
                'data' => new ProductVariantResource($productVariant)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create product variant',
                'error' =>  $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        return new ProductVariantResource($productVariant);
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
    public function update(Request $request, ProductVariant $productVariant)
    {
        try {
            $data = $request->validate([
                'product_id' => ['required', 'integer'],
                'productName' => ['required', 'string', 'max:255'],
                'productPrice' => ['required', 'string', 'max:100'],
            ]);

            $productVariant->update($data);

            return response()->json([
                'message' => 'Product variant updated successfully',
                'data' => new ProductVariantResource($productVariant)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update product variant',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $productVariant)
    {
        try {
            $productVariant->delete();

            return response()->json([
                'message' => 'Product variant deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product variant',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
