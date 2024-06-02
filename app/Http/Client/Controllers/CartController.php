<?php

namespace App\Http\Client\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Client\Cart;
use App\Models\Shop\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected CartService $service;

    public function __construct() {
        if( auth('client')->check() ){
            $this->service = new CartService(auth("client")->user()->cart);
        }
    }

    public function items()
    {

        if( !auth('client')->check() ){
            return response()->json([
                'messsage' => 'you must be logged in'
            ]);
        }

        $client = auth('client')->user();

        $p = Product::all()->first();

        return response()->json([
           'items' => [$p]
        ], 200);
    }


    public function increament(Product $product){

        if( $this->service->increament($product->id) ){
            return response()->json([
                "message" => "successfully increamented",
                "status" => "success"
            ]);
        }

        return response()->json([
            "message" => "failed increamented",
            "status" => "fail",
            'product' => $product
        ]);
    }

    public function decreament(Product $product){
        if( $this->service->decreament($product->id) ){
            return response()->json([
                "message" => "successfully decreament",
                "status" => "success"
            ]);
        }

        return response()->json([
            "message" => "failed decreament",
            "status" => "fail"
        ]);
    }

    public function remove(Product $product){
        if( $this->service->remove($product->id) ){
            return response()->json([
                "message" => "successfully removed",
                "status" => "success"
            ]);
        }

        return response()->json([
            "message" => "failed removed",
            "status" => "fail"
        ]);
    }
}
