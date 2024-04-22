<?php

namespace App\Providers;

use App\Enums\CommandStatus;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //dd(CommandStatus::values());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Authenticate::redirectUsing(function(\Illuminate\Http\Request $request){
            return route($request->subdomain . ".login", ['domain' => "seller"]);
        });
        AuthenticationException::redirectUsing(function(\Illuminate\Http\Request $request){
            return route($request->subdomain . ".login");
        });

        /* if(! $this->hasSubDomain()){
            throw new NoSubdomainException();
        } */

        $domain = $this->extractSubdomain();

        request()->subdomain = count($domain) > 2 ? $domain[0] : null;
    }

    protected function hasSubDomain() : bool{
        $url_parts = $this->extractSubdomain();

        return count($url_parts) > 2;
    }

    protected function extractSubdomain(){
        return (explode(".", request()->host()));
    }
}
