<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('admin.layouts.admin', function ($view) {
            $view->with('notificationsCount', Notification::whereNull('read_at')->count());
        });
    }
}