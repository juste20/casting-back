<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaiementCallbackController extends Controller
{
    public function handle(Request $request)
    {
        \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret_key'));
        \FedaPay\FedaPay::setEnvironment(config('services.fedapay.environment'));

        try {
            $transaction = \FedaPay\Transaction::retrieve($request->id);

            $status = $transaction->status;

            // Message utilisateur en français
            $message = match ($status) {
                'approved' => 'Paiement réussi avec succès.',
                'declined' => 'Paiement refusé. Fonds insuffisants.',
                'canceled' => 'Paiement annulé par l’utilisateur.',
                default => 'Paiement en attente de confirmation.'
            };

            // Enregistrement en base
            Payment::updateOrCreate(
                [
                    'transaction_id' => $transaction->id,
                ],
                [
                    'reference' => $transaction->reference,
                    'email' => $transaction->customer->email ?? null,
                    'amount' => $transaction->amount,
                    'status' => $status,
                ]
            );

            return response()->json([
                'statut' => $status,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'statut' => 'erreur',
                'message' => 'Impossible de vérifier le paiement.',
                'erreur' => $e->getMessage()
            ], 500);
        }
    }
}