<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KkiapayService;

class PaymentController extends Controller
{
    public function init(Request $request)
    {
        return app(KkiapayService::class)->initiate($request);
    }
}
