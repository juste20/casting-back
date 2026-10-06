<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('castings:archive', function () {
    $done = app(\App\Services\ArchiveService::class)->runAll();
    $this->info(sprintf(
        'Archives : %d casting(s), %d inscription(s), %d paiement(s).',
        $done['castings'], $done['subscriptions'], $done['payments']
    ));
})->purpose('Archiver castings expires, inscriptions et paiements traites');