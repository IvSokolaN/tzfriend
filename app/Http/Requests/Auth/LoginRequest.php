<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email обязательно для заполнения',
            'email.email' => 'Email должен быть валидным',
            'email.exists' => 'Email не существует',
            'password.required' => 'Пароль обязательно для заполнения',
            'password.string' => 'Пароль должен быть строкой',
        ];
    }
}
