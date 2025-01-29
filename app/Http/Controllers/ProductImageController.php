<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImageRequest;
use App\Http\Resources\Product\ProductImageCollection;
use App\Http\Resources\Product\ProductImageResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Service\ProductImageService;

class ProductImageController extends Controller
{
    public function __construct(protected ProductImageService $imageService)
    {
    }

    public function index($product_id)
    {
        try {
            $images = $this->imageService->getAllById($product_id);
            return $this->successResponse(new ProductImageCollection($images));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function store($product_id, ProductImageRequest $request)
    {
        $images = $this->imageService->create($product_id, $request);
        return $this->successResponse(new ProductImageResource($images));

    }

    public function show($product_id, $image_id)
    {
        try {
            $images = $this->imageService->getOne($product_id, $image_id);
            return $this->successResponse(new ProductImageResource($images));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function update($product_id, $image_id, ProductImageRequest $request)
    {
        try {
            $images = $this->imageService->update($request, $product_id, $image_id);
            return $this->successResponse(new ProductImageResource($images));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy($product_id, $image_id)
    {
        try {
            $this->imageService->delete($product_id, $image_id);
            return $this->successResponse(null, 204);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }
}
