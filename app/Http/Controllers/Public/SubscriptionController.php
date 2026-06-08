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
        $data = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'actor_id' => 'required',
            'categories' => 'required|array',
            'payment_reference' => 'required'
        ]);

        $payment = Payment::where('reference', $data['payment_reference'])
            ->where('status', 'success')
            ->first();

        if (!$payment) {
            return response()->json([
                'message' => 'Aucun paiement valide trouvé pour cette référence.'
            ], 400);
        }

        return Subscription::create($data);
    }
}
