<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use Illuminate\Http\Request;

class CastingController extends Controller
{
    /**
     * PAGE ADMIN - Liste des castings reçus
     */
    public function index()
    {
        $castings = Casting::latest()->get();

        return view('admin.castings', compact('castings'));
    }

    /**
     * VOIR UN CASTING (debug/API)
     */
    public function show($id)
    {
        $casting = Casting::findOrFail($id);

        return response()->json($casting);
    }

    /**
     * VALIDER UN CASTING
     */
    public function validateCasting(Request $request, $id)
    {
        $casting = Casting::findOrFail($id);

        $casting->status = 'validated';
        $casting->save();

        return response()->json([
            'message' => 'Casting validé avec succès',
            'casting_id' => $casting->id
        ]);
    }

    /**
     * REJETER UN CASTING
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'nullable|string|max:255'
        ]);

        $casting = Casting::findOrFail($id);

        $casting->status = 'rejected';
        $casting->rejection_reason = $request->reason;
        $casting->save();

        return response()->json([
            'message' => 'Casting rejeté avec succès',
            'casting_id' => $casting->id
        ]);
    }

    /**
     * HISTORIQUE DES CASTINGS
     */
    public function history()
    {
        $castings = Casting::latest()->get();

        return view('admin.history-castings', compact('castings'));
    }
}