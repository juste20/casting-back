<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Payment;

class UserController extends Controller
{
    /**
     * Liste toutes les inscriptions (dashboard admin)
     */
    public function index()
    {
        return response()->json(Subscription::latest()->get());
    }

    /**
     * Inscription candidat avec paiement FedaPay
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'actorChosen' => 'nullable|integer',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|max:100',
        ]);

        if (Subscription::where('email', $validated['email'])->exists()) {
            return response()->json(['message' => 'Cet email est deja utilise'], 409);
        }

        $amount = 2000;
        $reference = 'SUB-' . strtoupper(uniqid());

        $payment = Payment::create([
            'email' => $validated['email'],
            'amount' => $amount,
            'method' => 'fedapay',
            'reference' => $reference,
            'status' => 'pending',
            'payload' => [
                'fullname' => $validated['name'],
                'email' => $validated['email'],
                'country' => $validated['country'],
                'actor_id' => $validated['actorChosen'] ?? null,
                'categories' => $validated['categories'],
            ]
        ]);

        try {
            \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret_key'));
            \FedaPay\FedaPay::setEnvironment(config('services.fedapay.environment'));

            $transaction = \FedaPay\Transaction::create([
                "description" => "Inscription Casting.net",
                "amount" => $amount,
                "currency" => ["iso" => "XOF"],
                "callback_url" => config('app.url') . "/api/v1/payment/callback?reference=" . $reference,
                "reference" => $reference,
                "customer" => [
                    "email" => $validated['email'],
                    "firstname" => explode(' ', $validated['name'])[0],
                    "lastname" => explode(' ', $validated['name'])[1] ?? '',
                ]
            ]);

            $token = $transaction->generateToken();

            $payment->update([
                'payload' => array_merge($payment->payload ?? [], [
                    'transaction_id' => $transaction->id,
                    'fedapay_token' => $token->token,
                ])
            ]);

            return response()->json([
                'payment_url' => $token->url,
                'reference' => $reference,
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('FedaPay registration error');

            return response()->json([
                'message' => 'Erreur lors de la creation du paiement. Veuillez reessayer.',
            ], 500);
        }
    }
}
