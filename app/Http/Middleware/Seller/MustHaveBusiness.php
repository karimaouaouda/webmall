<?php

namespace App\Http\Middleware\Seller;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustHaveBusiness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->guard("seller")->check()){
            // if there is no seller, just go to seller login
            return request()->expectsJson() ? response()->json([
                'message' => "sorry you must be logged in"
            ], 302) : redirect()->to(route('seller.login'));
        }

        if( !auth()->guard("seller")->user()->has_business ){
            return request()->expectsJson() ? response()->json([
                'message' => "sorry you must be logged in"
            ], 302) : redirect()->to(route('seller.login'));
        }

        
        return $next($request);
    }
}
