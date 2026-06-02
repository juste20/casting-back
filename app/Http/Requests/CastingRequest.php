<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CastingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'country' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
        ];
    }
}
