<?php

namespace App\Service;

use App\Http\Resources\Product\ProductImageCollection;
use App\Http\Resources\Product\ProductImageResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageService
{
    public function getAllById(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new \Exception("Товар с id: $id не найден.", 404);
        }
        return new ProductImageResource($product->productImages);
    }

    public function getOne($product_id, $image_id)
    {
        $image = $this->getImageByProductId($product_id, $image_id);
        return $image;
    }

    public function create($product_id, Request $request)
    {
        $data = $request->validated();
        $product = Product::find($product_id);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('ProductImages', 'public');
        }

        return $product->productImages()->create($data);
    }

    public function update(Request $request, $product_id, $image_id)
    {
        $image = $this->getImageByProductId($product_id, $image_id);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if (isset($image->image)) {
                Storage::disk('public')->delete("ProductImages/" . basename($image->image));
            }
            $data['image'] = $request->file('image')->store('ProductImages', 'public');
        }

        $image->update($data);
        return $image;
    }

    public function delete($product_id, $image_id): void
    {
        $image = $this->getImageByProductId($product_id, $image_id);
        $image->delete();
    }

    private function getImageByProductId($product_id, $image_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            throw new \Exception("Товар с id: $product_id не найден.", 404);
        }

        $image = $product->productImages()->find($image_id);
        if (!$image) {
            throw new \Exception("Изображение с id: $image_id не найдено для товара с id: $product_id.", 404);
        }

        return $image;
    }
}
