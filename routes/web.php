<?php

use App\Events\Test;
use App\Exceptions\NoSubdomainException;
use App\Http\Client\Controllers\CartController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ClientController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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



Route::domain("{domain}.webmall.test")->group(function () {

    $request = request();

    if ($request->subdomain() === null) {

        throw new NoSubdomainException("no subdomain exception", 302, $request->path() . "?" . $request->getQueryString());
    }

    foreach (Config::get('app.reserved.subdomains') as $dom){
        if( $request->subdomain() == $dom ){
            return;
        }
    }

    Route::controller(ShopController::class)
            ->name('shop.')
            ->group(function(){

                Route::get('/', 'view');

            });




    Route::get('/pass/{name}', function($name){
        return \Illuminate\Support\Facades\Hash::make($name);
    });

    Route::middleware([])->group(function () {
        Route::get('/test', function () {
            $collection = \App\Models\Shop\Product::all();

            foreach ($collection as $obj){
                $obj->karim = [
                    'name' => 'karim'
                ];
            }

            dd($collection);
            return "hhh";
        });
    });

    /**
     * this section here is for social login using one of the services in cofig/service.php
     */

});
