<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request){
        $ip = $request->ip();

        session([
            $ip => null
        ]);

        return view("welcome", ['ip' => $ip]);
    
    }
}
