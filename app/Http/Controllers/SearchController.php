<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        $q = mb_strtolower(request('q'));
        $products = Product::with([
            'category',
            'productImages' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id');
            },
            'properties',
            'relates' => function ($query) {
                $query->orderBy('title');
            }
        ])
            ->whereRaw('lower(title) like ?', ["%{$q}%"])
            ->orderBy('title')
            ->get();
        return new ProductCollection($products);
    }
}
