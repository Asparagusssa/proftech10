<?php

namespace App\Action\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DeleteImageAction
{
    public function __invoke($category_id)
    {
        $category = Category::find($category_id);

        if (isset($category->image)) {
            Storage::disk('public')->delete('categories/' . basename($category->image));
        }
        $category->update([
            'image' => null,
        ]);

        return $category;
    }
}
