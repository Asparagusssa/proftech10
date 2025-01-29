<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'image' => ['nullable', 'image'],
            'related_title' => ['nullable', 'max:255'],
            'order' => ['nullable', 'numeric'],
        ];
    }
}
