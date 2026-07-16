<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Controllers publics
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Public\CastingPublicController;
use App\Http\Controllers\Public\ActorController;
use App\Http\Controllers\Public\SubscriptionController;
use App\Http\Controllers\Public\PaymentController as PublicPaymentController;

/*
|--------------------------------------------------------------------------
| Controllers admin
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CastingController;
use App\Http\Controllers\Admin\InscriptionController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Auth\AdminAuthController;

/*
|--------------------------------------------------------------------------
| =========================
|        ROUTES PUBLIQUES
| =========================
*/

/*
| Castings publics
*/
Route::get('/castings', [CastingPublicController::class, 'index'])
    ->name('castings.index');

Route::get('/castings/{id}', [CastingPublicController::class, 'show'])
    ->name('castings.show');

/*
| Acteurs
*/
Route::get('/actors', [ActorController::class, 'index'])
    ->name('actors.index');

Route::get('/actors/{id}', [ActorController::class, 'show'])
    ->name('actors.show');

/*
| Inscription acteurs
*/
Route::post('/subscription', [SubscriptionController::class, 'store'])
    ->name('subscription.store')
    ->middleware('fraud');

/*
| Paiement
*/
Route::post('/payment/init', [PublicPaymentController::class, 'init'])
    ->name('payment.init');

Route::post('/payment/callback', [PublicPaymentController::class, 'callback'])
    ->name('payment.callback');



/*
|--------------------------------------------------------------------------
| =========================
|      AUTH ADMIN (PUBLIC)
| =========================
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

/*
| Password Reset
*/
Route::get('/admin/forgot-password', [AdminAuthController::class, 'showLinkRequestForm'])
    ->name('admin.password.request');

Route::post('/admin/forgot-password', [AdminAuthController::class, 'sendResetLinkEmail'])
    ->name('admin.password.email');

Route::get('/admin/reset-password/{token}', [AdminAuthController::class, 'showResetForm'])
    ->name('admin.password.reset');

Route::post('/admin/reset-password', [AdminAuthController::class, 'resetPassword'])
    ->name('admin.password.update');



/*
|--------------------------------------------------------------------------
| =========================
|      ROUTES ADMIN
| =========================
| Toutes les routes protégées par le middleware "admin"
*/

Route::prefix('admin')
    ->middleware(AdminMiddleware::class)
    ->name('admin.')
    ->group(function () {

        /*
        | Dashboard
        */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        | Castings
        */
        Route::get('/castings', [CastingController::class, 'index'])
            ->name('castings');

        Route::get('/castings/{id}', [CastingController::class, 'show'])
            ->name('castings.show');

        Route::post('/castings/{id}/validate', [CastingController::class, 'validateCasting'])
            ->name('castings.validate');

        Route::post('/castings/{id}/reject', [CastingController::class, 'rejectCasting'])
            ->name('castings.reject');

        Route::delete('/castings/{id}', [CastingController::class, 'destroy'])
            ->name('castings.delete');

        /*
        | Inscriptions
        */
        Route::get('/subscriptions', [InscriptionController::class, 'index'])
            ->name('subscriptions');

        Route::get('/subscriptions/{id}', [InscriptionController::class, 'show'])
            ->name('subscriptions.show');

        Route::post('/subscriptions/{id}/approve', [InscriptionController::class, 'approve'])
            ->name('subscriptions.approve');

        Route::post('/subscriptions/{id}/reject', [InscriptionController::class, 'reject'])
            ->name('subscriptions.reject');

        Route::post('/subscriptions/{id}/sent', [InscriptionController::class, 'sent'])
            ->name('subscriptions.sent');

        Route::post('/subscriptions/{id}/received', [InscriptionController::class, 'received'])
            ->name('subscriptions.received');

        /*
        | Paiements
        */
        Route::get('/payments', [PaymentController::class, 'index'])
            ->name('payments');

        Route::get('/payments/{id}', [PaymentController::class, 'show'])
            ->name('payments.show');

        /*
        | Historiques
        */
        Route::get('/history/castings', [CastingController::class, 'history'])
            ->name('history.castings');

        Route::get('/history/subscriptions', [InscriptionController::class, 'history'])
            ->name('history.subscriptions');

        /*
        | Archives
        */
        Route::get('/archives', [ArchiveController::class, 'index'])
            ->name('archives');

        Route::post('/archives/run', [ArchiveController::class, 'run'])
            ->name('archives.run');

        /*
        | Notifications
        */
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');

        Route::get('/notifications/count', [NotificationController::class, 'count'])
            ->name('notifications.count');

        /*
        | Logout admin
        */
        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
