<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Page admin des notifications
     */
    public function index()
    {
        $notifications = Notification::latest()->get();

        return view('admin.notifications', compact('notifications'));
    }
}