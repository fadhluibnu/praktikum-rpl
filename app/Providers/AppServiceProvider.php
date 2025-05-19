<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

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
        // Configure the HTTP client with custom SSL certificate
        // Http::defaultOptions([
        //     'verify' => storage_path('cacert.pem'),
        //     // Alternatively, you can directly specify the path:
        //     // 'verify' => 'C:\\xampp\\php\\cacert.pem',
        // ]);
    }
}
