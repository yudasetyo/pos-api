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
    public function index(Request $request)
    {
        $productVariantDTs = ProductVariantDT::all();
        if ($request->is('api/*')) {
            // API request
            return response()->json([
                'productVariantDTs' => ProductVariantDTResource::collection($productVariantDTs),
            ]);
        } else {
            // Web request
            return view('admin.productVariantDT.index', compact('productVariantDTs'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productVariantDT.create');
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
            $productVariantDT = DB::transaction(function () use ($request, $data) {
                // Create the product variant item
                return ProductVariantDT::create($data);
            });

            if ($request->is('api/*')) {
                // API response
                // Return a successful response with the new product variant item resource
                return response()->json([
                    'message' => 'Product variant item created successfully',
                    'productVariantDTs' => new ProductVariantDTResource($productVariantDT)
                ], 201);
            } else {
                return redirect()->route('productVariantDTs.index')->with('success', 'Product variant item created successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to create product variant item',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to create product variant item: ' . $e->getMessage());
            }
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
        $productVariantDT = ProductVariantDT::findOrFail($id);

        return view('admin.productVariantDT.edit', compact('productVariantDT'));
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
            $updatedProductVariantDT = DB::transaction(function () use ($productVariantDT, $data) {
                // Update the product variant item
                $productVariantDT->update($data);

                return $productVariantDT;                
            });

            if ($request->is('api/*')) {
                // API response
                // Return a successful response with the new product variant item resource
                return response()->json([
                    'message' => 'Product variant item updated successfully',
                    'productVariantDTs' => new ProductVariantDTResource($updatedProductVariantDT)
                ], 200);
            } else {
                // Web response
                return redirect()->route('productVariantDTs.index')
                                 ->with('success', 'Product variant item updated successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to update product variant item',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to update product variant item: ' . $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ProductVariantDT $productVariantDT)
    {
        try {
            // Handle the database transaction
            $response = DB::transaction(function () use ($productVariantDT) {
                // Delete the product
                $productVariantDT->delete();
            });

            if ($request->is('api/*')) {
                // API response
                return response()->json([
                    'message' => 'Product variant item deleted successfully'
                ], 200);
            } else {
                // Web response
                return redirect()->route('productVariantDTs.index')
                                 ->with('success', 'Product variant item deleted successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to delete product variant item',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->with('error', 'Failed to delete product variant item: ' . $e->getMessage());
            }
        }
    }
}
