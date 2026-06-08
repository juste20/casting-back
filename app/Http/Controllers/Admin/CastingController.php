<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Subscription;
use App\Models\Notification;
use App\Mail\CastingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CastingController extends Controller
{
    public function index()
    {
        $castings = Casting::latest()->get();
        return view('admin.castings', compact('castings'));
    }

    public function show($id)
    {
        $casting = Casting::findOrFail($id);
        return response()->json($casting);
    }

    public function validateCasting(Request $request, $id)
    {
        $casting = Casting::findOrFail($id);
        $casting->update(['status' => 'validated']);

        Notification::create([
            'type' => 'casting',
            'message' => "Casting approuve : {$casting->title}",
        ]);

        try {
            Mail::to($casting->promoter_email)->send(new CastingNotification($casting, 'approved'));
        } catch (\Exception $e) {
            // silence
        }

        return redirect()->back()->with('success', 'Casting valide avec succes');
    }

    public function rejectCasting(Request $request, $id)
    {
        $casting = Casting::findOrFail($id);
        $casting->update([
            'status' => 'rejected',
            'rejection_reason' => $request->reason,
        ]);

        Notification::create([
            'type' => 'casting',
            'message' => "Casting rejete : {$casting->title}" . ($request->reason ? " - {$request->reason}" : ""),
        ]);

        try {
            Mail::to($casting->promoter_email)->send(new CastingNotification($casting, 'rejected'));
        } catch (\Exception $e) {
            // silence
        }

        return redirect()->back()->with('success', 'Casting rejete');
    }

    public function destroy($id)
    {
        Casting::findOrFail($id)->delete();
        return redirect()->route('admin.castings')->with('success', 'Casting supprime');
    }

    public function history()
    {
        $castings = Casting::latest()->get();
        return view('admin.history-castings', compact('castings'));
    }
}
