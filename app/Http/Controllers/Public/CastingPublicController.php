<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use Illuminate\View\View;

class CastingPublicController extends Controller
{
    public function available()
    {
        return Casting::where('status', 'validated')->get();
    }

    public function index(): View
    {
        $castings = Casting::where('status', 'validated')->latest()->get();
        return view('castings', compact('castings'));
    }

    public function show($id): View
    {
        $casting = Casting::findOrFail($id);
        return view('casting-detail', compact('casting'));
    }
}
