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

    Route::get('/', fn () => "seller page");
    

    Route::controller(\App\Http\Controllers\Auth\SellerController::class)
        ->middleware("guest:seller")
        ->group(function (){

        Route::get("/login", "create")->name("login");

        Route::post("/login", "store");

        Route::get('/register', 'registerView')->name('register');

        Route::post('register', 'register');
    });
});