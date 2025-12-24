<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'father_name'=> ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'biography'  => ['nullable', 'string'],
            'gender'     => ['required', 'string'],
            'active'     => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Имя обязательно для заполнения.',
            'first_name.string'   => 'Имя должно быть строкой.',
            'first_name.max'      => 'Имя не должно превышать 255 символов.',

            'last_name.required' => 'Фамилия обязательна для заполнения.',
            'last_name.string'   => 'Фамилия должна быть строкой.',
            'last_name.max'      => 'Фамилия не должна превышать 255 символов.',

            'father_name.required' => 'Отчество обязательно для заполнения.',
            'father_name.string'   => 'Отчество должно быть строкой.',
            'father_name.max'      => 'Отчество не должно превышать 255 символов.',

            'birth_date.date' => 'Дата рождения должна быть корректной датой.',

            'biography.string' => 'Биография должна быть текстом.',

            'gender.required' => 'Пол обязателен для выбора.',
            'gender.boolean'  => 'Пол указан некорректно.',

            'active.boolean' => 'Статус активности указан некорректно.',
        ];
    }

}
