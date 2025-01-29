<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'price' => ['nullable', 'numeric'],
        ];
    }
}
