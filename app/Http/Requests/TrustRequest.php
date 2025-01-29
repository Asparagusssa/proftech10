<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrustRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'image' => ['required', 'image', 'max:6140'],
            'order' => ['nullable', 'integer'],
        ];

        if($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules['image'] = ['nullable', 'image', 'max:6140'];
        }

        return $rules;
    }
}
