<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Casting;
use Illuminate\Support\Facades\Storage;

class CastingApiController extends Controller
{
    /**
     * 🎬 CREATE CASTING (Vue JS)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5',
            'country' => 'required|string',
            'description' => 'required|string|min:20',

            'promoter_email' => 'required|email',
            'promoter_phone' => 'required|string',

            'categories' => 'required',

            'poster' => 'nullable|image|max:5120',
        ]);

        // 📌 IMAGE UPLOAD
        $posterPath = null;

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('castings', 'public');
        }

        // 📌 CASTING CREATE
        $casting = Casting::create([
            'title' => $request->title,
            'country' => $request->country,
            'date' => now()->toDateString(),
            'time' => now()->format('H:i'),

            'description' => $request->description,

            'categories' => is_string($request->categories)
                ? json_decode($request->categories, true)
                : $request->categories,

            'poster' => $posterPath,

            'promoter_email' => $request->promoter_email,
            'promoter_phone' => $request->promoter_phone,

            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Casting créé avec succès',
            'data' => $casting
        ]);
    }
}