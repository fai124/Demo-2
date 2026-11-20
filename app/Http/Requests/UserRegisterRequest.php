<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|min:6|unique:users,login',
            'password' => 'required|min:8',
            'FIO' => 'required',
            'number' => 'required|integer',
            'email' => 'required|email|unique:users,email',
        ];
    }
}
