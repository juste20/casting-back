<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class InscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::latest()->get();
        $payments = \App\Models\Payment::whereIn('email', $subscriptions->pluck('email'))->get()->keyBy('email');
        return view('admin.subscriptions', compact('subscriptions', 'payments'));
    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return response()->json($subscription);
    }

    public function approve($id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Inscription approuvee');
    }

    public function reject($id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Inscription rejetee');
    }

    public function sent($id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->update(['status' => 'sent']);
        return redirect()->back()->with('success', 'Infos envoyees au candidat');
    }

    public function received($id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->update(['status' => 'received']);
        return redirect()->back()->with('success', 'Confirmation de reception');
    }

    public function history()
    {
        $subscriptions = Subscription::latest()->get();
        return view('admin.history-subscriptions', compact('subscriptions'));
    }
}
