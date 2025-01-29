<?php

namespace App\Http\Controllers;

use App\Action\Category\DeleteImageAction;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\PropertyCollection;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $categories = $this->categoryService->getAll($request);
            return $this->successResponse(new CategoryCollection($categories));
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create($request);
            return $this->successResponse(new CategoryResource($category));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            $category = $this->categoryService->getOne($category->id);
            return $this->successResponse(new CategoryResource($category));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category = $this->categoryService->update($request, $category->id);
            return $this->successResponse(($category));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $this->categoryService->delete($category->id);
            return $this->successResponse(null, 204);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteImage($category_id, DeleteImageAction $action)
    {
        try {
            $response = $action($category_id);
            return $this->successResponse(new CategoryResource($response));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function getProperties($category_id)
    {
        $category = Category::find($category_id);
        return Property::where('category_id', $category->id)->orderBy('value')->get();
    }
}
