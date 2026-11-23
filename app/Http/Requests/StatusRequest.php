<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => 'required|in:new,studying,completed',
        ];
    }
}
