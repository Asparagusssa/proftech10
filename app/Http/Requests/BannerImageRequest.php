<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerImageRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'image' => ['required', 'image', 'max:6140'],
            'order' => ['nullable', 'integer'],
        ];

        if ($this->method() === 'PATCH' || $this->method() === 'PUT') {
            $rules['image'] = ['nullable', 'image', 'max:6140'];
        }

        return $rules;
    }
}
