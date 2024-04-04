<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        

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
