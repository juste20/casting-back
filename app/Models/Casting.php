<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casting extends Model
{
    protected $fillable = [
    'title',
    'country',
    'date',
    'time',
    'start_date',
    'end_date',
    'description',
    'poster',
    'promoter_email',
    'promoter_phone',
    'status',
    'rejection_reason'
];

    protected $casts = [
    'categories' => 'array'
];

    public function categories()
    {
        return $this->belongsToMany(CastingCategory::class);
    }
}
