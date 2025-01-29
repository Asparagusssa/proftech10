<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\PropertyCollection;
use App\Models\Product;
use App\Models\Property;

class ProductPropertyController extends Controller
{
    public function index(Product $product)
    {
        $properties = $product->properties;
        return new PropertyCollection($properties, 200);
    }

    public function attach(Product $product, Property $property)
    {
        $product->properties()->syncWithoutDetaching($property->id);

        return response()->json(['message' => 'OK'], 200);
    }

    public function detach(Product $product, Property $property)
    {
        $product->properties()->detach($property->id);

        return response()->json(['message' => 'OK'], 200);
    }
}
