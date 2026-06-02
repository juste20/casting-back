<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CastingApiController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\WebhookController;


/*
|--------------------------------------------------------------------------
| API Routes v1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    /*
    |-----------------------------
    | STATS DASHBOARD
    |-----------------------------
    */
    Route::get('/stats', [StatsController::class, 'index']);

    /*
    |-----------------------------
    | INSCRIPTION CANDIDAT
    |-----------------------------
    */
    Route::post('/users/register', [UserController::class, 'register']);

    /*
    |-----------------------------
    | CREATION CASTING ENTREPRISE
    |-----------------------------
    */
    Route::post('/castings', [CastingApiController::class, 'store']);
    /*
    |-----------------------------
    | IMAGES CASTING
    |-----------------------------
    */
    Route::get('/castings/{id}/poster', [CastingApiController::class, 'poster']);
    /*
    |-----------------------------
    | PAIEMENT
    |-----------------------------
    */
    Route::post('/payments', [PaymentController::class, 'createPayment']);
    /*
    |-----------------------------
    | WEBHOOKS
    |-----------------------------
    */
    Route::post('/webhooks/fedapay', [WebhookController::class, 'handleFedaPayWebhook']);
});