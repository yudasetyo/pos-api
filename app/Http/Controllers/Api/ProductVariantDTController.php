<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariantDTResource;
use App\Http\Resources\ProductVariantResource;
use App\Models\ProductVariantDT;
use Illuminate\Http\Request;

class ProductVariantDTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productVariantDTs = ProductVariantDT::latest()->paginate(10);
        return ProductVariantDTResource::collection($productVariantDTs);
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
                'product_variant_id' => ['required', 'integer'],
                'productVariantDTName' => ['required', 'string', 'max:255'],
                'productVariantPrice' => ['required', 'integer', 'min:3']
            ]);

            $productVariantDT = ProductVariantDT::create($data);

            return response()->json([
                'message' => 'Product variant item created successfully',
                'data' => new ProductVariantDTResource($productVariantDT
                )
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create product variant item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariantDT $productVariantDT)
    {
        return new ProductVariantResource($productVariantDT);
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
    public function update(Request $request, ProductVariantDT $productVariantDT)
    {
        try {
            $data = $request->validate([
                'product_variant_id' => ['required', 'integer'],
                'productVariantDTName' => ['required', 'string', 'max:255'],
                'productVariantPrice' => ['required', 'integer', 'min:3']
            ]);

            $productVariantDT->update($data);

            return response()->json([
                'message' => 'Product variant item updated successfully',
                'data' => new ProductVariantDTResource($productVariantDT)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update product variant item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariantDT $productVariantDT)
    {
        try {
            $productVariantDT->delete();

            return response()->json([
                'message' => 'Product variant item deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product variant item',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
