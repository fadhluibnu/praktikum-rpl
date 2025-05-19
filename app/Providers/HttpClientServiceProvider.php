<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class HttpClientServiceProvider extends ServiceProvider
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
        // Configure the default HTTP client
        Http::macro('configureDefaultClient', function () {
            return Http::withOptions([
                // 'verify' => storage_path('cacert.pem'),
                // Or use absolute path like:
                'verify' => 'C:\\xampp\\php\\cacert.pem',
            ]);
        });
    }
}
