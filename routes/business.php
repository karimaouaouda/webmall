<?php

use App\Http\Controllers\Business\BusinessController;
use Illuminate\Support\Facades\Route;



Route::controller(BusinessController::class)
->name('business.')
->group(function(){

    Route::get('creation', 'create')->name("business.register");

    Route::get('/', 'index')->name('index');

    
    Route::middleware('auth:seller')->group(function(){

        Route::get('/create', 'create')->name('create');

    });


});