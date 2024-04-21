<?php

namespace App\Providers;

use App\Actions\Fortify\Auth\Client\AttemptToAuthenticate;
use App\Actions\Fortify\Auth\Client\RedirectIfTwoFactorAuthenticatable;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ClientController;
use App\Http\Controllers\Auth\SellerController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    private function loadAuthMigrations(): static
    {
        $this->loadMigrationsFrom(base_path("/database/migrations/auth"));
        return $this;
    }
    /**
     * Register services.
     */
    public function register(): void
    {

        //load migrations
        $this->loadAuthMigrations();
        //link every guard with it's classes

        $this->app->when([
            ClientController::class,
            RedirectIfTwoFactorAuthenticatable::class,
            AttemptToAuthenticate::class,
            AuthController::class
        ])->needs(StatefulGuard::class)
            ->give(function(){
                return Auth::guard("client");
            });

        $this->app->when([
            SellerController::class,
            \App\Actions\Fortify\Auth\Seller\RedirectIfTwoFactorAuthenticatable::class,
            \App\Actions\Fortify\Auth\Seller\AttemptToAuthenticate::class
        ])->needs(StatefulGuard::class)
            ->give(function(){
                return Auth::guard("seller");
            });

        $this->app->when([
            AdminController::class,
            \App\Actions\Fortify\Auth\Admin\RedirectIfTwoFactorAuthenticatable::class,
            \App\Actions\Fortify\Auth\Admin\AttemptToAuthenticate::class
        ])->needs(StatefulGuard::class)
            ->give(function(){
                return Auth::guard("admin");
            });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
