<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantDTRequest;
use App\Http\Requests\UpdateProductVariantDTRequest;
use App\Http\Resources\ProductVariantDTResource;
use App\Http\Resources\ProductVariantResource;
use App\Models\ProductVariantDT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(StoreProductVariantDTRequest $request)
    {
        try {
            // Validate the request data
            $data = $request->validated();

            // Handle the database transaction
            $response = DB::transaction(function () use ($data) {
                // Create the product variant item
                $productVariantDT = ProductVariantDT::create($data);

                // Return a successful response with the new product variant item resource
                return response()->json([
                    'message' => 'Product variant item created successfully',
                    'data' => new ProductVariantDTResource($productVariantDT)
                ], 201);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
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
    public function update(UpdateProductVariantDTRequest $request, ProductVariantDT $productVariantDT)
    {
        try {
            // Validate the request data
            $data = $request->validated();

            // Handle the database transaction
            $response = DB::transaction(function () use ($productVariantDT, $data) {
                // Update the product variant item
                $productVariantDT->update($data);

                // Return a successful response with the new product variant item resource
                return response()->json([
                    'message' => 'Product variant item updated successfully',
                    'data' => new ProductVariantDTResource($productVariantDT)
                ], 200);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
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
            // Handle the database transaction
            $response = DB::transaction(function () use ($productVariantDT) {
                // Delete the product
                $productVariantDT->delete();

                // Return a successful response
                return response()->json([
                    'message' => 'Product variant item deleted successfully'
                ], 200);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
            return response()->json([
                'message' => 'Failed to delete product variant item',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
