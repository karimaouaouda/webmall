<?php

use App\Exceptions\Business\DoesntHaveBusinessException;
use App\Exceptions\NoSubdomainException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(function(){
            return route("seller.login");
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NoSubdomainException $e, Request $request) {
            return redirect()->to($e->getRedirectUrl());
        });

        $exceptions->render(function(DoesntHaveBusinessException $e, Request $request ){
            return redirect()->to($e->getRedirectUrl());
        });
    })
    ->create();
