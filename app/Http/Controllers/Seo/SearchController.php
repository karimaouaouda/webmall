<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{


    public function search(){

        $products = Product::all();

        return view('discover', compact('products'));

    }

}
