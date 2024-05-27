<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('interests', function(){

    $all = \App\Models\Setup\SubCategory::all();

    return response()->json([
        'interests' => $all
    ]);
});
