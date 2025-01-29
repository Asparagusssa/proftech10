<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageSectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'image' => ['nullable', 'image', 'max:6240'],
            'section_type_id' => ['required', 'exists:section_types,id'],
            'order' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
