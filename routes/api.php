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
    Route::post('/contact', [ContactController::class, 'store'])->middleware(['throttle:10,1', 'fraud']);
    Route::post('/payment/init', [ApiPaymentController::class, 'init'])->middleware('throttle:10,1');
    Route::post('/payments', [ApiPaymentController::class, 'createPayment'])->middleware('throttle:10,1');
    Route::post('/users/register', [UserController::class, 'register'])->middleware(['throttle:5,1', 'fraud']);

    // Routes protégées par token Sanctum
    Route::middleware('api.auth')->group(function () {
        Route::get('/stats', [StatsController::class, 'index']);
        Route::get('/users/all', [UserController::class, 'index']);
        Route::post('/castings', [CastingApiController::class, 'store']);
        Route::put('/castings/validate/{id}', [CastingApiController::class, 'validateCasting']);
        Route::get('/castings/{id}/poster', [CastingApiController::class, 'poster']);
        Route::get('/payments/all', [ApiPaymentController::class, 'index']);
    });

    // Password Reset API
    Route::post('/admin/forgot-password', [AdminAuthController::class, 'forgotPasswordApi'])->middleware('throttle:3,1');
    Route::post('/admin/reset-password', [AdminAuthController::class, 'resetPasswordApi'])->middleware('throttle:3,1');

    // Webhooks
    Route::post('/webhooks/fedapay', [WebhookController::class, 'handleFedaPayWebhook']);
});

// Callback FedaPay (POST uniquement pour securite)
Route::post('/v1/payment/callback', [App\Http\Controllers\Api\PaymentController::class, 'callback'])->middleware('throttle:30,1');
