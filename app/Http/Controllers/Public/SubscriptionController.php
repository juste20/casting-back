<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'actor_id' => 'required',
            'categories' => 'required|array'
        ]);

        return Subscription::create($data);
    }
}
