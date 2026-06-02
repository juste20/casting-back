<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Actor;

class ActorController extends Controller
{
    public function index()
    {
        return Actor::inRandomOrder()->get();
    }
}
