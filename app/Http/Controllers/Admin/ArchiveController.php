<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Services\CastingService;
use App\Services\ArchiveService;

class ArchiveController extends Controller
{
    public function index()
    {
        $castings = Archive::where('type', 'casting')
            ->latest()
            ->get();

        $subscriptions = Archive::where('type', 'subscription')
            ->latest()
            ->get();

        $payments = Archive::where('type', 'payment')
            ->latest()
            ->get();

        return view('admin.archives', compact(
            'castings',
            'subscriptions',
            'payments'
        ));
    }

    /* public function run()
    {
        app(CastingService::class)->archiveExpired();

        return redirect()->route('admin.archives')
            ->with('success', 'Archivage effectue avec succes');
    } */

                public function run()
    {
        $done = app(ArchiveService::class)->runAll();

        return redirect()->route('admin.archives')
            ->with('success', sprintf(
                'Archivage effectue : %d casting(s), %d inscription(s), %d paiement(s).',
                $done['castings'], $done['subscriptions'], $done['payments']
            ));
    }
}
