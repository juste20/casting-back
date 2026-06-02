<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Subscription;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'castings_pending' => Casting::where('status', 'pending')->count(),
            'subscriptions_pending' => Subscription::where('status', 'pending')->count(),
            'payments_pending' => Payment::where('status', 'pending')->count(),
        ]);
    }
}