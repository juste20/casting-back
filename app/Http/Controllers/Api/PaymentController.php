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
        $hash = $request->hash;

        if (!$reference || !$hash) {
            return view('payment_status', [
                'status' => 'erreur',
                'message' => 'Parametres invalides.',
            ]);
        }

        $expectedHash = hash_hmac('sha256', $reference, config('app.key'));
        if (!hash_equals($expectedHash, $hash)) {
            return view('payment_status', [
                'status' => 'erreur',
                'message' => 'Verification echouee.',
            ]);
        }

        $payment = Payment::where('reference', $reference)->first();

        if (!$payment) {
            return view('payment_status', [
                'status' => 'inconnu',
                'message' => 'Paiement introuvable.',
            ]);
        }

        \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret_key'));
        \FedaPay\FedaPay::setEnvironment(config('services.fedapay.environment'));

        try {
            $transaction = \FedaPay\Transaction::retrieve($payment->payload['transaction_id'] ?? null);
            $status = $transaction->status;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Payment callback verification failed: ' . $e->getMessage());
            $status = 'error';
        }

        if ($status === 'approved' && $payment->status !== 'success') {
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
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        $amount = 2000;

        $payment = Payment::create([
            'email' => $request->email,
            'amount' => $amount,
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
            'payment_url' => config('app.url') . '/payment/callback?reference=' . $payment->reference . '&hash=' . hash_hmac('sha256', $payment->reference, config('app.key')),
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

        $amount = 2000;
        $reference = uniqid('cast_');

        try {
            $transaction = \FedaPay\Transaction::create([
                "description" => "Paiement inscription casting",
                "amount" => (int) $amount,
                "currency" => ["iso" => "XOF"],
                "callback_url" => config('app.url') . "/api/v1/payment/callback?reference=" . $reference . "&hash=" . hash_hmac('sha256', $reference, config('app.key')),
                "reference" => $reference,
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
            \Illuminate\Support\Facades\Log::error('FedaPay createPayment error');
            return response()->json([
                'message' => 'Erreur lors de la creation du paiement',
            ], 500);
        }
    }
}
