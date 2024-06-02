<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;


Route::get('pass/{pass}',function($pass){
    return Hash::make($pass);
} );

Route::get('/register', fn () => "hello there" );

Route::name("seller.")->group(function(){

    Route::controller(\App\Http\Controllers\Auth\SellerController::class)
        ->middleware("guest:seller")
        ->group(function (){

        Route::get("/login", "create")->name("login");

        Route::post("/login", "store");

        Route::get('/register', 'registerView')->name('register');

        Route::post('register', 'register');

    });

    Route::controller(\App\Http\Controllers\AddressController::class)
        ->name('address.')
        ->group(function(){

            Route::post('/shop/update', 'update')->name('update');

        });

    Route::controller(\App\Http\Controllers\ShopController::class)
        ->name('shop.')
        ->group(function(){

            Route::get('/shop/start', 'start')->name('start');

        });

    Route::controller(\App\Http\Controllers\Base\IdentityController::class)
        ->name('identity.')
        ->group(function(){

            Route::post('/id/upload', 'upload' )->name('upload');

        });


//    Route::get('/verify/id', 'IDVerificationView')->name('id.verify');
//
//    Route::post('/verify/id', 'handleIdVerification');
});
