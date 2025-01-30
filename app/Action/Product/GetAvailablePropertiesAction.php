<?php

namespace App\Action\Product;

use App\Models\Product;
use App\Models\Property;

class GetAvailablePropertiesAction
{
    public function __invoke($productId)
    {
        $product = Product::find($productId);

        return Property::where('category_id', $product->category_id)
            ->whereDoesntHave('products', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->orderBy('value')
            ->get();
    }
}
