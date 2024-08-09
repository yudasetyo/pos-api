<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Http\Resources\ProductVariantResource;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productVariants = ProductVariant::latest()->paginate(10);
        
        if ($request->is('api/*')) {
            // API request
            return ProductVariantResource::collection($productVariants);
        } else {
            // Web request
            return view('admin.productVariant.index', compact('productVariants'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productVariant.create');
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
            $productVariant = DB::transaction(function () use ($data) {
                // Create the product variant
                return ProductVariant::create($data);
            });

            if ($request->is('api/*')) {
                // API response
                // Return a successful response with the new product variant resource
                return response()->json([
                    'message' => 'Product Variant label created successfully',
                    'data' => new ProductVariantResource($productVariant)
                ], 201);
            } else {
                return redirect()->route('productVariants.index')->with('success', 'Product variant label successfully');
            }
            
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to create product variant label',
                    'error' =>  $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to create product variant label: ' . $e->getMessage());
            }
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
        $productVariant = ProductVariant::findOrFail($id);

        return view('admin.productVariant.edit', compact('productVariant'));
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
            $updatedProductVariant = DB::transaction(function () use ($data, $productVariant) {
                // Update the product variant
                $productVariant->update($data);

                return $productVariant;
            });

            if ($request->is('api/*')) {
                // Return a successful response with the updated product variant resource
                return response()->json([
                    'message' => 'Product variant label updated successfully',
                    'data' => new ProductVariantResource($updatedProductVariant)
                ], 200);
            } else {
                // Web response
                return redirect()->route('productVariants.index')
                                 ->with('success', 'Product variant label updated successfully');
            }
        } catch (\Exception $e) {
            // Return a failure response with the error message
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to update product variant label',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to update product variant label: ' . $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ProductVariant $productVariant)
    {
        try {
            // Handle the database transaction
            DB::transaction(function () use ($productVariant) {
                // Delete the product
                $productVariant->delete();
            });

            if ($request->is('api/*')) {
                // API response
                return response()->json([
                    'message' => 'Product variant label deleted successfully'
                ], 200);
            } else {
                // Web response
                return redirect()->route('products.index')
                                 ->with('success', 'Product deleted successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to delete product variant label',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->with('error', 'Failed to delete product variant label: ' . $e->getMessage());
            }
        }
    }
}
