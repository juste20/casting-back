<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Auth\AuthenticationException;
use App\Services\CastingService;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(fn () => app(CastingService::class)->archiveExpired())
            ->dailyAt('00:00')
            ->description('Archiver les castings expires');
    })
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('web', \App\Http\Middleware\SecurityHeaders::class);

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'api.auth' => \App\Http\Middleware\ApiAuthenticate::class,
            'fraud' => \App\Http\Middleware\PreventFraud::class,
            'verify.payment' => \App\Http\Middleware\VerifyPayment::class,
            'check.country' => \App\Http\Middleware\CheckCountry::class,
            'api.locale' => \App\Http\Middleware\ApiLocalization::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
