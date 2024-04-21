<?php

namespace App\Http\Controllers;

use App\Models\Shop\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request){
        return view("guest.welcome");
    }


    public function discover(){
        $products  = Product::all();

        return view("discover", compact('products'));
    }
}
