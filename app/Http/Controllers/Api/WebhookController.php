<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Subscription;

class WebhookController extends Controller
{
    public function handleFedaPayWebhook(Request $request)
    {
        \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret_key'));
        \FedaPay\FedaPay::setEnvironment(config('services.fedapay.environment'));

        try {
            $transaction = \FedaPay\Transaction::retrieve($request->id);
            $status = $transaction->status;
            $reference = $transaction->reference;

            $payment = Payment::where('reference', $reference)->first();

            if (!$payment) {
                return response()->json(['message' => 'Paiement introuvable'], 404);
            }

            if ($status === 'approved' && $payment->status !== 'success') {
                // Creer la souscription
                $payload = $payment->payload;
                Subscription::create([
                    'fullname' => $payload['fullname'] ?? $payment->email,
                    'email' => $payload['email'] ?? $payment->email,
                    'country' => $payload['country'] ?? 'Autre',
                    'actor_id' => $payload['actor_id'] ?? null,
                    'categories' => $payload['categories'] ?? [],
                    'status' => 'pending',
                    'payment_reference' => $reference,
                ]);

                $payment->update(['status' => 'success']);

                \App\Models\Notification::create([
                    'type' => 'paiement',
                    'message' => "Paiement webhook - " . number_format($payment->amount, 0, ',', ' ') . " FCFA - " . ($payload['email'] ?? $payment->email),
                ]);
            } elseif (in_array($status, ['declined', 'canceled'])) {
                $payment->update(['status' => 'failed']);
            }

            return response()->json([
                'statut' => $status,
                'message' => match ($status) {
                    'approved' => 'Paiement reussi. Inscription finalisee.',
                    'declined' => 'Paiement refuse.',
                    'canceled' => 'Paiement annule.',
                    default => 'Paiement en attente de confirmation.',
                }
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Webhook error: ' . $e->getMessage());
            return response()->json([
                'statut' => 'erreur',
                'message' => 'Impossible de verifier le paiement.',
            ], 500);
        }
    }
}
