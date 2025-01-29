<?php

namespace App\Http\Resources\Product;

use App\Http\Controllers\PropertyController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Relate\RelateCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'properties' => new PropertyCollection($this->whenLoaded('properties')),
            'relates' => new RelateCollection($this->whenLoaded('relates')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => new ProductImageCollection($this->whenLoaded('productImages')),
        ];
    }
}
