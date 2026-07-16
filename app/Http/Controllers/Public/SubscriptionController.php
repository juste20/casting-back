<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'actor_id' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'string|max:100',
            'payment_reference' => 'required|string|max:255'
        ]);

        $payment = Payment::where('reference', $validated['payment_reference'])
            ->where('status', 'success')
            ->first();

        if (!$payment) {
            return response()->json([
                'message' => 'Aucun paiement valide trouve pour cette reference.'
            ], 400);
        }

        $subscription = Subscription::create([
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'country' => $validated['country'],
            'actor_id' => $validated['actor_id'],
            'categories' => $validated['categories'],
            'payment_reference' => $validated['payment_reference'],
            'status' => 'pending',
        ]);

        return response()->json($subscription);
    }
}
