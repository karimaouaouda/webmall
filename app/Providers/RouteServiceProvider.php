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
        $this->registerRoutes();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }

    public function registerRoutes()
    {
        Route::domain('business.webmall.test')
            ->middleware('web')
            ->group(base_path('routes/business.php'));
        Route::domain("admin.webmall.test")
            ->middleware("web")
            ->group(base_path("routes/admin.php"));

        Route::domain("seller.webmall.test")
            ->middleware("web")
            ->group(base_path('routes/seller.php'));

        
    }
}
