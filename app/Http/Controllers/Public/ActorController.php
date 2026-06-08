<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\View\View;

class ActorController extends Controller
{
    public function index(): View
    {
        $actors = Actor::inRandomOrder()->get();
        return view('actors', compact('actors'));
    }

    public function show($id): View
    {
        $actor = Actor::findOrFail($id);
        return view('actor-detail', compact('actor'));
    }
}
