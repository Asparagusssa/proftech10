<?php

namespace App\Http\Controllers;

use App\Action\Product\GetAvailablePropertiesAction;
use App\Action\Product\GetAvailableRelatesAction;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\PropertyCollection;
use App\Http\Resources\Relate\RelateCollection;
use App\Models\Product;
use App\Models\Property;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $products = $this->productService->getAll($request);
            return new ProductCollection($products);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productService->create($request);
            return $this->successResponse(new ProductResource($product));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $this->productService->getOne($product->id);
        return $this->successResponse(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = $this->productService->update($request, $product->id);
            return $this->successResponse(new ProductResource($product));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->productService->delete($product->id);
            return $this->successResponse(null, 204);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function availableRelates(Product $product, GetAvailableRelatesAction $action)
    {
        $relates = $action($product->id);
        return new RelateCollection($relates);
    }

    public function availableProperties(Product $product, GetAvailablePropertiesAction $action)
    {
        $properties = $action($product->id);
        return new PropertyCollection($properties);
    }
}
