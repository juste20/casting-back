<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CastingApiController;
use App\Http\Controllers\Api\PaymentController as ApiPaymentController;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Auth\AdminAuthController;

/*
|--------------------------------------------------------------------------
| API Routes v1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->middleware('api.locale')->group(function () {
    // Routes PUBLIQUES (pas d'auth requise)
    Route::post('/admin/login', [AdminAuthController::class, 'loginApi'])->middleware('throttle:5,1');
    Route::get('/castings', [CastingApiController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store'])->middleware('fraud');
    Route::post('/payment/init', [ApiPaymentController::class, 'init']);
    Route::post('/payments', [ApiPaymentController::class, 'createPayment']);
    Route::post('/users/register', [UserController::class, 'register'])->middleware(['throttle:30,5', 'fraud']);

    // Routes protégées par token Sanctum
    Route::middleware('api.auth')->group(function () {
        Route::get('/stats', [StatsController::class, 'index']);
        Route::get('/users/all', [UserController::class, 'index']);
        Route::post('/castings', [CastingApiController::class, 'store']);
        Route::put('/castings/validate/{id}', [CastingApiController::class, 'validateCasting']);
        Route::get('/castings/{id}/poster', [CastingApiController::class, 'poster']);
        Route::get('/payments/all', [ApiPaymentController::class, 'index']);
    });

    // Webhooks - pas d'auth, mais devrait être vérifié par signature
    Route::post('/webhooks/fedapay', [WebhookController::class, 'handleFedaPayWebhook']);
});

// Callback FedaPay (sans prefix v1 pour compatibilite)
Route::get('/v1/payment/callback', [App\Http\Controllers\Api\PaymentController::class, 'callback']);
