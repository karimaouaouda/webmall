<?php

use App\Events\Test;
use App\Exceptions\NoSubdomainException;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ClientController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Models\Shop\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Routing\Router;



Route::domain('client.' . env('APP_HOST'))->group(function () {
    Route::controller(\App\Http\Controllers\Auth\ClientController::class)
        ->middleware(["guest:client"])
        ->name('client.')
        ->group(function () {

            Route::get('/login', 'create')->name('login');

            Route::post('/login', 'store');

            Route::get('/register', "registerView")->name('register');

            Route::post('/register', "register");

            Route::post('/registerhandler', 'handle');
        });
});


Route::domain("www." . env('APP_HOST') )->group(function(){

    Route::controller(ProductController::class)
    ->name('product.')
    ->group(function(){

        Route::get('/view/{product}', 'shop')->name('view');

    });

});

Route::domain("{domain}.webmall.test")->group(function () {

    $request = request();

    if ($request->subdomain === null) {

        throw new NoSubdomainException("no subdomain exception", 302, $request->path() . "?" . $request->getQueryString());
    }

    Route::controller(MainController::class)
        ->group(function () {

            Route::get('/discover', 'discover')->name('discover');
        });

    Route::middleware('auth:client')->group(function () {
        Route::get('/test', function () {
            return "hhh";
        });
    });


    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index');
    });

    /**
     * this section here is for social login using one of the services in cofig/service.php
     */
    Route::controller(ClientController::class)->name("social.")->prefix("auth")
        ->group(function () {

            Route::get('redirect/{service}', "socialRedirect")->name("redirect");

            Route::get('/{service}/callback', 'socialCallback')->name('callback');
        });

    Route::get('/watch', function () {
        return view("watch");
    });

    Route::domain("seller.webmall.test")->group(function () {
        Route::get('/', function () {
            return "hello from another domain";
        });
    });

    Route::post('/fire', function () {
        event(new Test("hello from event"));
        return response()->json([
            "message" => "hello there"
        ], 200);
    });

    /**
     * this art is for global routes
     * for example email verification
     */

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth:client')->name('verification.notice');



    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

        if ($request->subdomain != "seller") {
            throw new NoSubdomainException("this route is valid just for seller and www subdomains", direction: route("seller.register"));
        }


        $request->fulfill();

        return redirect('/dashboard');
    })->middleware(['auth:client', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:client', 'throttle:6,1'])->name('verification.send');
});
