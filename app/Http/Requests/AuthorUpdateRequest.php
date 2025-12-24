<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'last_name'  => ['nullable', 'string', 'min:2', 'max:255'],
            'father_name'=> ['nullable', 'string', 'min:2', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'biography'  => ['nullable', 'string'],
            'gender'     => ['nullable', 'string'],
            'active'     => ['nullable', 'boolean'],
        ];
    }
}
