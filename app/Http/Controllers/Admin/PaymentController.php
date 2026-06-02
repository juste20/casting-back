<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Page admin des paiements (Blade)
     */
    public function index()
    {
        $payments = Payment::latest()->get();

        return view('admin.payments', compact('payments'));
    }
}