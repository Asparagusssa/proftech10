<?php

namespace App\Action\Product;

use App\Models\Product;
use App\Models\Relate;

class GetAvailableRelatesAction
{
    public function __invoke($productId)
    {
        $product = Product::find($productId);

        return Relate::whereDoesntHave('products', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->orderBy('title')->get();
    }
}
