<?php

namespace App\Http\Middleware\Seller;

use App\Exceptions\Business\DoesntHaveBusinessException;
use App\Models\Auth\Seller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AssertHavingShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $seller = Auth::guard("seller")->user();

        if( ! $seller->has_shop ){
            throw new DoesntHaveBusinessException($seller->name);
        }

        return $next($request);
    }
}
