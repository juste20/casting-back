<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'email','amount','method','reference',
        'status','payload','consumed_at','archived_at'
    ];

    protected $casts = [
        'payload' => 'array',
        'consumed_at' => 'datetime',
        'archived_at' => 'datetime',
    ];

    // Valide = réussi, pas encore consommé par un mail, pas archivé
    public function scopeValid(Builder $query): Builder
    {
        return $query->where('status', 'success')
            ->whereNull('consumed_at')
            ->whereNull('archived_at');
    }
}