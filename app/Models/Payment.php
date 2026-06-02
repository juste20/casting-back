<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'email','amount','method','reference',
        'status','payload'
    ];

    protected $casts = [
        'payload' => 'array'
    ];
}
