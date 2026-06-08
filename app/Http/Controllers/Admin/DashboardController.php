<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'castings_pending' => Casting::where('status', 'pending')->count(),
            'castings_sent' => Casting::where('status', 'validated')->count(),
            'subscriptions_pending' => Subscription::where('status', 'pending')->count(),
            'payments_pending' => Payment::where('status', 'pending')->count(),
            'notificationsCount' => Notification::whereNull('read_at')->count(),
        ]);
    }
}