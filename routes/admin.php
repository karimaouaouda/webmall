<?php

use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\Auth\AdminController::class)
->name("admin.")
->group(function (){

    Route::get("/login", "create")->name("login");

    Route::post("/login", "store");

    Route::get('register', 'registerView');
});
