<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Callback apres paiement FedaPay
     */
    public function callback(Request $request)
    {
        $reference = $request->reference;
        $status = $request->status;

        $payment = Payment::where('reference', $reference)->first();

        if ($payment && $status === 'approved') {
            $payload = $payment->payload;
            \App\Models\Subscription::firstOrCreate(
                ['email' => $payload['email'] ?? $payment->email],
                [
                    'fullname' => $payload['fullname'] ?? $payment->email,
                    'country' => $payload['country'] ?? 'Autre',
                    'actor_id' => $payload['actor_id'] ?? null,
                    'categories' => $payload['categories'] ?? [],
                    'status' => 'pending',
                    'payment_reference' => $reference,
                ]
            );
            $payment->update(['status' => 'success']);

            \App\Models\Notification::create([
                'type' => 'paiement',
                'message' => "Nouveau paiement de " . number_format($payment->amount, 0, ',', ' ') . " FCFA - " . ($payload['fullname'] ?? $payment->email),
            ]);
        } elseif ($payment) {
            $payment->update(['status' => 'failed']);
        }

        return view('payment_status', [
            'status' => $status ?? 'inconnu',
            'message' => match ($status) {
                'approved' => 'Paiement reussi ! Votre inscription est finalisee.',
                'declined', 'canceled' => 'Paiement echoue ou annule.',
                default => 'Statut inconnu.',
            }
        ]);
    }
    /**
     * Liste tous les paiements (dashboard admin)
     */
    public function index()
    {
        return response()->json(Payment::latest()->get());
    }

    /**
     * Initie un paiement (frontend Vue)
     */
    public function init(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'amount' => 'required|numeric|min:100',
        ]);

        $payment = Payment::create([
            'email' => $request->email,
            'amount' => $request->amount,
            'method' => 'kkiapay',
            'reference' => Str::uuid(),
            'status' => 'pending',
            'payload' => [
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phone' => $request->phone,
            ]
        ]);

        return response()->json([
            'payment_url' => config('app.url') . '/payment/callback?reference=' . $payment->reference,
            'reference' => $payment->reference
        ]);
    }

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
            \Illuminate\Support\Facades\Log::error('FedaPay createPayment error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Erreur lors de la création du paiement',
            ], 500);
        }
    }
}