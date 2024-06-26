<?php

/**
 * here wll store community routes
*/

use App\Http\Controllers\Community\CommunityController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::controller(CommunityController::class)
    ->group(function(){

        Route::get('/', 'index');

    });

Route::controller(PostController::class)
    ->name('post.')
    ->group(function(){

        Route::get('/create', 'create')->name('create');


        Route::post('/post/publish', 'publish')->name('publish');

    });
