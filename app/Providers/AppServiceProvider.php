<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Device\Service as DeviceService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('DeviceService', DeviceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
