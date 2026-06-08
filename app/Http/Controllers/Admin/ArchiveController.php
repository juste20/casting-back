<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Services\CastingService;

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

    public function run()
    {
        app(CastingService::class)->archiveExpired();

        return redirect()->route('admin.archives')
            ->with('success', 'Archivage effectue avec succes');
    }
}
