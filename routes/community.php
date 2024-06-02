<?php

/**
 * here wll store community routes
*/

use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return 'i will handle this';
});

Route::controller(\App\Http\Controllers\PostController::class)
    ->name('post.')
    ->group(function(){

        Route::get('/create', 'create')->name('create');


        Route::post('/post/publish', 'publish')->name('publish');

    });
