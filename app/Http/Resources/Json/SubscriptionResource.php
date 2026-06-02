<?php

namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'fullname' => $this->fullname,
            'email' => $this->email,
            'country' => $this->country
        ];
    }
}
