<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Casting;
use App\Events\CastingCreated;
use Illuminate\Support\Facades\Storage;

class CastingApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Casting::where('status', 'validated')->latest()->get()
        );
    }

    public function validateCasting($id)
    {
        $casting = Casting::findOrFail($id);
        $casting->status = 'validated';
        $casting->save();

        return response()->json([
            'message' => 'Casting valide avec succes',
            'casting_id' => $casting->id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'country' => 'required|string|max:100',
            'description' => 'required|string|min:20|max:5000',
            'promoter_email' => 'required|email',
            'promoter_phone' => 'required|string|max:20',
            'categories' => 'required|array',
            'categories.*' => 'string|max:100',
            'poster' => 'nullable|image|mimes:jpeg,png,gif,webp|max:5120',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $posterPath = null;

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('castings', 'local');
        }

        $casting = Casting::create([
            'title' => $request->title,
            'country' => $request->country,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'date' => $request->start_date,
            'time' => now()->format('H:i'),
            'description' => $request->description,
            'categories' => $request->categories,
            'poster' => $posterPath,
            'promoter_email' => $request->promoter_email,
            'promoter_phone' => $request->promoter_phone,
            'status' => 'pending'
        ]);

        event(new CastingCreated($casting));

        return response()->json([
            'message' => 'Casting cree avec succes',
            'data' => $casting
        ]);
    }
}
