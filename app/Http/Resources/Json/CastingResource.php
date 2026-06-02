<?php

namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;

class CastingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'country' => $this->country,
            'date' => $this->date,
            'status' => $this->status
        ];
    }
}
