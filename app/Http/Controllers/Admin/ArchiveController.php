<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;

class ArchiveController extends Controller
{
    /**
     * Page principale des archives (ADMIN BLADE)
     */
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
}