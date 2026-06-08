<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KkiapayService;

class PaymentController extends Controller
{
    public function init(Request $request)
    {
        return app(KkiapayService::class)->initiate($request);
    }

    public function callback(Request $request)
    {
        $status = $request->status;
        $message = match ($status) {
            'success' => 'Paiement réussi !',
            'canceled' => 'Paiement annulé.',
            default => 'Statut inconnu.',
        };

        return view('payment_status', compact('status', 'message'));
    }
}
