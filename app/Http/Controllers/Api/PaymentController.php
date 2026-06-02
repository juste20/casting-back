<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret_key'));
        \FedaPay\FedaPay::setEnvironment(config('services.fedapay.environment'));

        $request->validate([
            'amount' => 'required|numeric|min:100',
            'email' => 'required|email',
            'full_name' => 'required|string|max:100'
        ]);

        try {
            $transaction = \FedaPay\Transaction::create([
                "description" => "Paiement inscription casting",
                "amount" => (int) $request->amount,
                "currency" => ["iso" => "XOF"],
                "callback_url" => config('app.url') . "/api/paiement/callback",
                "reference" => uniqid('cast_'),
                "customer" => [
                    "email" => $request->email,
                    "firstname" => explode(' ', $request->full_name)[0],
                    "lastname" => explode(' ', $request->full_name)[1] ?? ''
                ]
            ]);

            return response()->json([
                'token' => $transaction->generateToken(),
                'message' => 'Redirection vers la page de paiement'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la création du paiement',
                'erreur' => $e->getMessage()
            ], 500);
        }
    }
}