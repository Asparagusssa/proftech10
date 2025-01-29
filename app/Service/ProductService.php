<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function getAll(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        return Product::filter()->with([
            'category',
            'productImages' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id');
            },
            'properties',
            'relates' => function ($query) {
                $query->orderBy('title');
            }
        ])->paginate($perPage);
    }

    public function getOne($id)
    {
        return Product::with([
            'category' => function ($query) {},
            'productImages' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id');
            },
            'properties',
            'relates' => function ($query) {
                $query->orderBy('title');
            },
        ])->find($id);
    }

    public function create(Request $request)
    {
        $data = $request->validated();
        return Product::create($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $product = Product::find($id);
        $product->update($data);
        return $product->load('category');
    }

    public function delete($id): void
    {
        $product = Product::find($id);
        $product->delete();
    }
}
