<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['required', 'max:254'],
            'email' => ['required', 'email', 'max:254'],
            'address' => ['required', 'max:254'],
        ];
    }
}
