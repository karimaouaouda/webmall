<?php


use App\Http\Client\Controllers\CartController;
use App\Http\Controllers\Auth\ClientController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::controller(MainController::class)->group(function () {
    Route::get('/interests', 'interests');
    Route::get('/', 'index');

    Route::post('/message/send', 'send');
});


Route::controller(MainController::class)
    ->group(function () {

        Route::get('/discover', 'discover')->name('discover');
    });


Route::controller(InterestController::class)
    ->name('interests.')
    ->group(function(){
        Route::post('/interests/save', 'save')->name('upload');
    });

Route::controller(ProductController::class)
    ->name('product.')
    ->group(function(){

        Route::get('/products/{product}/view', 'show')->name('view');

    });


Route::controller(\App\Http\Controllers\Seo\SearchController::class)
    ->group(function(){

        Route::get('/search', 'search')->name('search');

    });


Route::controller(CommandController::class)
    ->name('command.')
    ->middleware(['auth:client'])
    ->group(function(){

        Route::get('checkout/', 'create')->name('pay');

        Route::post('checkout/', 'store');



    });


Route::controller(CartController::class)
    ->name('cart.')
    ->group(function(){
        Route::get('/cart/items', 'items');

        Route::post('/cart/push', 'addItem');
    });

Route::controller(ClientController::class)->name("social.")->prefix("auth")
    ->group(function () {

        Route::get('redirect/{service}', "socialRedirect")->name("redirect");

        Route::get('/{service}/callback', 'socialCallback')->name('callback');
    });
