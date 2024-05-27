<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shop\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(Request $request): View|Application|Factory
    {
        $shops = Shop::all();
        $products = Product::all();
        return view("guest.welcome", compact('shops', 'products'));
    }

    public function interests(){
        return view('interests');
    }


    public function discover(){
        $products  = Product::all();

        return view("discover", compact('products'));
    }
}
