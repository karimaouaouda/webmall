<?php

namespace App\Providers;

use App\Enums\CommandStatus;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
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
            if($request->subdomain() == 'business'){
                return route('seller.register');
            }
            return route("client.login");
        });
        AuthenticationException::redirectUsing(function(\Illuminate\Http\Request $request){
            if($request->subdomain() == 'business'){
                return route('seller.register');
            }
            return route("client.login");
        });

        /* if(! $this->hasSubDomain()){
            throw new NoSubdomainException();
        } */

        $self = $this;

        Request::macro("subdomain", function() use ($self){
            $domain = $self->extractSubdomain();

            return count($domain) > 2 ? $domain[0] : null;
        });

    }

    protected function hasSubDomain() : bool{
        $url_parts = $this->extractSubdomain();

        return count($url_parts) > 2;
    }

    public function extractSubdomain(){
        return (explode(".", request()->host()));
    }
}
