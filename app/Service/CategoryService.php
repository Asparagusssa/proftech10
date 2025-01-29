<?php

namespace App\Service;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;
use function PHPUnit\Framework\isNull;

class CategoryService
{
    public function getAll()
    {
        return Category::with([
            'products' => function ($query) {
                $query->orderBy('title');
            }
        ])->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('title')->get();
    }

    public function getOne($id)
    {
        return Category::with('products')->find($id);
    }

    public function create(Request $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        return Category::create($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validated();

        $category = Category::find($id);
        if ($request->hasFile('image')) {
            if (isset($category->image)) {
                Storage::disk('public')->delete('categories/' . basename($category->image));
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return $category->load('products');
    }

    public function delete($id): void
    {
        $category = Category::find($id);
        if (isset($category->image)) {
            Storage::disk('public')->delete('categories/' . basename($category->image));
        }
        $category->delete();
    }
}
