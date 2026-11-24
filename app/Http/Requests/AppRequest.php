<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'course_name' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'payment' => 'required',
        ];

    }
}
