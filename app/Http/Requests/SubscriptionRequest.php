<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'fullname' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'actor_id' => 'required'
        ];
    }
}
