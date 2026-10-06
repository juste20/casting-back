<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Services\CastingService;
use Illuminate\Http\Request;

class CastingController extends Controller
{
    public function index()
    {
        $castings = Casting::where('status', '!=', 'archived')->latest()->get();
        return view('admin.castings', compact('castings'));
    }

    public function show($id)
    {
        return response()->json(Casting::findOrFail($id));
    }

    public function validateCasting(Request $request, $id, CastingService $castingService)
    {
        $casting = Casting::findOrFail($id);

        if (!$castingService->validate($casting)) {
            return redirect()->back()->with('error', 'Ce casting a deja ete traite.');
        }

        return redirect()->back()->with('success', 'Casting valide avec succes');
    }

    public function rejectCasting(Request $request, $id, CastingService $castingService)
    {
        $data = $request->validate([
            'reason' => 'required|string|min:3|max:1000',
        ], [
            'reason.required' => 'Le motif du rejet est obligatoire.',
            'reason.min' => 'Le motif du rejet est trop court.',
        ]);

        $casting = Casting::findOrFail($id);

        if (!$castingService->reject($casting, trim($data['reason']))) {
            return redirect()->back()->with('error', 'Ce casting a deja ete traite.');
        }

        return redirect()->back()->with('success', 'Casting rejete. Le promoteur a ete informe du motif.');
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