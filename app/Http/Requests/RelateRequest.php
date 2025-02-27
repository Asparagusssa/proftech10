<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
        ];
    }
}
