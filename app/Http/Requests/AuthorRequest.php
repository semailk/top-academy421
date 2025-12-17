<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'last_name' => [
                        'required',
                        'min:2',
                        'max:255',
                        'string'
                    ],
                    'first_name' => [
                        'required',
                        'min:2',
                        'max:255',
                        'string'
                    ],
                    'father_name' => [
                        'required',
                        'min:2',
                        'max:255',
                        'string'
                    ]
                ];

            case 'PUT':
                return [
                    'last_name' => [
                        'required',
                        'min:2',
                        'max:255',
                        'string'
                    ],
                    'first_name' => [
                        'required',
                        'min:2',
                        'max:255',
                        'string'
                    ],
                    'father_name' => [
                        'required',
                        'min:2',
                        'max:255',
                        'string'
                    ],
                ];
            default:
                return ['last_name' => [
                    'required',
                    'min:2',
                    'max:255',
                    'string'
                ],
                                        'first_name' => [
                                            'required',
                                            'min:2',
                                            'max:255',
                                            'string'
                                        ],
                    'father_name' => [
                        'required',
                        'min:2',
                        'max:255',
                        'string'
                    ]];
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя к заполнению обязательно!',
            'name.min' => 'Минимальное количествр символов 3!',
            'name.max' => 'Максимальное количествр символов 10!',
        ];
    }
}
