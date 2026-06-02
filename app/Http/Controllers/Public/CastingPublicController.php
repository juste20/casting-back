<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Casting;

class CastingPublicController extends Controller
{
    public function available()
    {
        return Casting::where('status', 'validated')->get();
    }
}
