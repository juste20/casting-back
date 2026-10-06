<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->get();
        $unreadIds = $notifications->whereNull('read_at')->pluck('id')->all();

        // Le compteur revient à 0
        Notification::whereNull('read_at')->update(['read_at' => now()]);

        return view('admin.notifications', compact('notifications', 'unreadIds'));
    }

    public function count()
    {
        return response()->json([
            'count' => Notification::whereNull('read_at')->count(),
        ]);
    }
}