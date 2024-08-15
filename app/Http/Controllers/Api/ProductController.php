<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            $products = Product::all();
            // API request
            return response()->json([
                'products' => ProductResource::collection($products),
            ]);
        } else {
            $products = Product::paginate(10);
            // Web request
            return view('admin.product.index', compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.create', compact('categories'));
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
            $product = DB::transaction(function () use ($request, $data) {
                // Process the product image if it exists
                if ($request->hasFile('productImage')) {
                    $imagePath = $request->file('productImage')->store('productImages', 'public');
                    $data['productImage'] = $imagePath;
                }
    
                // Create the product record
                return Product::create($data);
            });

            // Determine if it's an API request
            if ($request->is('api/*')) {
                // API response
                // Return a successful response with the product resource
                return response()->json([
                    'message' => 'Product created successfully',
                    'products' => new ProductResource($product)
                ], 201);
            } else {
                return redirect()->route('product.index')->with('success', 'Product created successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to create product',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to create product: ' . $e->getMessage());
            }
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
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
    
            $updatedProduct = DB::transaction(function () use ($request, $data, $product) {
                if ($request->hasFile('productImage')) {
                    if ($product->productImage) {
                        Storage::disk('public')->delete($product->productImage);
                    }
                    $imagePath = $request->file('productImage')->store('productImages', 'public');
                    $data['productImage'] = $imagePath;
                }
    
                $product->update($data);
                return $product;
            });
    
            if ($request->is('api/*')) {
                // API response
                // Return a successful response with the updated product resource
                return response()->json([
                    'message' => 'Product updated successfully',
                    'products' => new ProductResource($updatedProduct)
                ], 200);
            } else {
                // Web response
                return redirect()->route('product.index')
                                 ->with('success', 'Product updated successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to update product',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'Failed to update product: ' . $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                // Delete the product
                $product->delete();
            });
    
            if ($request->is('api/*')) {
                // API response
                return response()->json([
                    'message' => 'Product deleted successfully'
                ], 200);
            } else {
                // Web response
                return redirect()->route('product.index')
                                 ->with('success', 'Product deleted successfully');
            }
        } catch (\Exception $e) {
            if ($request->is('api/*')) {
                // API error response
                return response()->json([
                    'message' => 'Failed to delete product',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                // Web error response
                return redirect()->back()
                                 ->with('error', 'Failed to delete product: ' . $e->getMessage());
            }
        }
    }
}
