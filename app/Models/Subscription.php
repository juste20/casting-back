<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'fullname','email','country',
        'actor_id','categories','status'
    ];

    protected $casts = [
        'categories' => 'array'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }
}
