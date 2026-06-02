<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;

class UserController extends Controller
{
    /**
     * Inscription candidat (Vue JS)
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:subscriptions,email',
            'country' => 'required|string',
            'actorChosen' => 'required|string',
            'categories' => 'required|array|min:1',
        ]);

        $subscription = Subscription::create([
            'fullname' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'actor_id' => $request->actorChosen,
            'categories' => $request->categories,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Inscription enregistrée avec succès',
            'data' => $subscription
        ]);
    }
}