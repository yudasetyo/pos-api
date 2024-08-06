<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Http\Resources\ProductVariantResource;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
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
    public function store(StoreProductVariantRequest $request)
    {
        try {
            // Validate the request data
            $data = $request->validated();

            // Handle the database transaction
            $response = DB::transaction(function () use ($data) {
                // Create the product variant
                $productVariant = ProductVariant::create($data);

                // Return a successful response with the new product variant resource
                return response()->json([
                    'message' => 'Product Variant label created successfully',
                    'data' => new ProductVariantResource($productVariant)
                ], 201);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
            return response()->json([
                'message' => 'Failed to create product variant label',
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
    public function update(UpdateProductVariantRequest $request, ProductVariant $productVariant)
    {
        try {
            // Validate the request data
            $data = $request->validated();

            // Handle the database transaction
            $response = DB::transaction(function () use ($data, $productVariant) {
                // Update the product variant
                $productVariant->update($data);

                // Return a successful response with the updated product variant resource
                return response()->json([
                    'message' => 'Product variant label updated successfully',
                    'data' => new ProductVariantResource($productVariant)
                ], 200);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
            return response()->json([
                'message' => 'Failed to update product variant label',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $productVariant)
    {
        try {
            // Handle the database transaction
            $response = DB::transaction(function () use ($productVariant) {
                // Delete the product
                $productVariant->delete();

                // Return a successful response
                return response()->json([
                    'message' => 'Product variant label deleted successfully'
                ], 200);
            });

            // Return the response from the transaction
            return $response;
        } catch (\Exception $e) {
            // Return a failure response with the error message
            return response()->json([
                'message' => 'Failed to delete product variant label',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
