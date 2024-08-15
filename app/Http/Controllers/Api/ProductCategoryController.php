<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            $productCategories = ProductCategory::all();
            // API request
            return response()->json([
                'productCategories' => ProductCategoryResource::collection($productCategories),
            ]);
        } else {
            $productCategories = ProductCategory::paginate(10);
            // Web request
            return view('admin.productCategory.index', compact('productCategories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        try {
            // Validate the request data
            $data = $request->validated();

            // Handle the database transaction
            $productCategory = DB::transaction(function () use ($data) {
                // Create the product category
                return ProductCategory::create($data);
            });

            if ($request->is('api/*')) {
                // API response
                // Return a successful response with the new product category resource
                return response()->json([
                    'message' => 'Product category created successfully',
                    'productCategory' => new ProductCategoryResource($productCategory)
                ], 201);
            } else {
                return redirect()->route('productCategory.index')->with('success', 'Product category successfully');
            }
            
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to create product category',
                    'error' =>  $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to create product category: ' . $e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productCategory = ProductCategory::findOrFail($id);

        return view('admin.productCategory.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        try {
            $data = $request->validated();
    
            $updatedProductCategory = DB::transaction(function () use ($data, $productCategory) {
                // Update the product category
                $productCategory->update($data);

                return $productCategory;
            });
    
            if ($request->is('api/*')) {
                // API response
                // Return a successful response with the updated product category resource
                return response()->json([
                    'message' => 'Product category updated successfully',
                    'products' => new ProductCategoryResource($updatedProductCategory)
                ], 200);
            } else {
                // Web response
                return redirect()->route('productCategory.index')
                                 ->with('success', 'Product category updated successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to update product category',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to update product category: ' . $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ProductCategory $productCategory)
    {
        try {
            // Handle the database transaction
            DB::transaction(function () use ($productCategory) {
                // Delete the product category
                $productCategory->delete();
            });

            if ($request->is('api/*')) {
                // API response
                return response()->json([
                    'message' => 'Product category deleted successfully'
                ], 200);
            } else {
                // Web response
                return redirect()->route('products.index')
                                 ->with('success', 'Product category deleted successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to delete product category',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->with('error', 'Failed to delete product category: ' . $e->getMessage());
            }
        }
    }
}
