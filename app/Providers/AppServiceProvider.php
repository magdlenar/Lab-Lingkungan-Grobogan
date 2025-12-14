<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Railway (and most PaaS) sits behind a reverse proxy and terminates TLS.
        // In production we should force generated URLs to use https so assets,
        // redirects, and form actions don't fall back to http.
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}