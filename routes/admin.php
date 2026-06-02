<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CastingController;
use App\Http\Controllers\Admin\InscriptionController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\NotificationController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Accès réservé aux administrateurs
*/

Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    /* Gestion des castings */
    Route::get('/castings', [CastingController::class, 'index']);
    Route::post('/castings/{id}/validate', [CastingController::class, 'validateCasting']);
    Route::post('/castings/{id}/reject', [CastingController::class, 'rejectCasting']);

    /* Inscriptions */
    Route::get('/subscriptions', [InscriptionController::class, 'index']);

    /* Paiements */
    Route::get('/payments', [PaymentController::class, 'index']);

    /* Archives */
    Route::get('/archives', [ArchiveController::class, 'index']);

    /* Notifications */
    Route::get('/notifications', [NotificationController::class, 'index']);
});
