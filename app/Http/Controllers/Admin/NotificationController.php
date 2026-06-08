<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->get();

        return view('admin.notifications', compact('notifications'));
    }

    public function count()
    {
        return response()->json([
            'count' => Notification::whereNull('read_at')->count(),
        ]);
    }
}