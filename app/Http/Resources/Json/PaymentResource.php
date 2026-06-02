<?php

namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'amount' => $this->amount,
            'status' => $this->status,
            'reference' => $this->reference
        ];
    }
}
