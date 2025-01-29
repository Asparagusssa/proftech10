<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'max:155'],
            'description' => ['required', 'max:255'],
            'image' => ['required', 'image', 'max:6140'],
            'file' => ['required', 'file'],
            'filename' => ['required_with:file', 'max:255'],
            'order' => ['required', 'integer'],
        ];

        if ($this->getMethod() === 'PUT' || $this->getMethod() === 'PATCH') {
            $rules['file'] = ['nullable', 'file'];
            $rules['image'] = ['nullable', 'image', 'max:6140'];
        }

        return $rules;
    }
}
