<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = [
        'type','data','reason','archived_at'
    ];

    protected $casts = [
        'data' => 'array',
        'archived_at' => 'datetime'
    ];
}
