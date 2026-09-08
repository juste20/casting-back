<?php

namespace App\Models;

use App\Mail\CastingSubmissionReceivedMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

    protected static function booted(): void
    {
        static::created(function (Casting $casting) {
            if (!$casting->promoter_email) {
                return;
            }

            try {
                Mail::to($casting->promoter_email)->send(new CastingSubmissionReceivedMail($casting));
            } catch (\Throwable $e) {
                Log::error('Echec envoi email de reception de casting', [
                    'casting_id' => $casting->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });
    }

    public function categories()
    {
        return $this->belongsToMany(CastingCategory::class);
    }
}