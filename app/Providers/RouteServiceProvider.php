<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerRoutes();
    }

    public function registerRoutes(){
        Route::domain("admin.webmall.test")
            ->middleware("web")
            ->group(base_path("routes/admin.php"));

        Route::domain("seller.webmall.test")
            ->middleware("web")
            ->group(base_path('routes/seller.php'));
    }
}
