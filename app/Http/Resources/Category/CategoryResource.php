<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'image' => $this->image,
            'related_title' => $this->related_title,
            'order' => $this->order,
            'products' => new ProductCollection($this->whenLoaded('products')),
        ];
    }
}
