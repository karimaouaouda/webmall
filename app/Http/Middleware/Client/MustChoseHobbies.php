<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustChoseHobbies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = auth('client')->user();
        if( $client == null ){
            abort(403, "you don't authorized here");
        }

        if( $client->interests()->count() <= 0 ){
            abort(403, "sorry dude");
        }

        return $next($request);
    }
}
