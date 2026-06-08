<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('castings:archive', function () {
    app(\App\Services\CastingService::class)->archiveExpired();
    $this->info('Castings expires archives avec succes.');
})->purpose('Archiver les castings dont la date de fin est depassee');
