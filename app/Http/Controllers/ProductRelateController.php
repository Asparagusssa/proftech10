<?php

namespace App\Http\Controllers;

use App\Http\Resources\Relate\RelateCollection;
use App\Models\Product;
use App\Models\Relate;

class ProductRelateController extends Controller
{
    public function index(Product $product)
    {
        $relates = $product->relates;
        return new RelateCollection($relates, 200);
    }

    public function attach(Product $product, Relate $relate)
    {
        $product->relates()->syncWithoutDetaching($relate->id);

        return response()->json(['message' => 'OK'], 200);
    }

    public function detach(Product $product, Relate $relate)
    {
        $product->relates()->detach($relate->id);

        return response()->json(['message' => 'OK'], 200);
    }
}
