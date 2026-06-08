<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Page admin des paiements (Blade)
     */
    public function index(): View
    {
        $payments = Payment::latest()->get();

        return view('admin.payments', compact('payments'));
    }

    /**
     * Détail d'un paiement (Blade)
     */
    public function show($id): View
    {
        $payment = Payment::findOrFail($id);

        return view('admin.payment-detail', compact('payment'));
    }
}