<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'image' => ['required', 'image'],
            'order' => ['nullable', 'integer'],
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
