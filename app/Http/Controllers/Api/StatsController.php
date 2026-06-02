<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Subscription;

class StatsController extends Controller
{
    public function index()
    {
        return response()->json([
    'users' => Subscription::count(),
    'castings' => Casting::count(),
    'pending_subscriptions' => Subscription::where('status', 'pending')->count(),
    'pending_castings' => Casting::where('status', 'pending')->count(),
    'daily_visits' => rand(3000, 6000)
]);
    }
}
