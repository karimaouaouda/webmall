<?php

namespace App\Services;

use App\Models\Client\Cart;
use App\Models\Shop\Product;
use Illuminate\Support\Facades\DB;

class CartService{

    protected Cart $cart;
    public function __construct( Cart $cart ) {
        $this->cart = $cart;
    }

    public function add($product_id){
        if( ($p = $this->cart->products->find($product_id)) ){
            return $this->increament($product_id);
        }else{
            $this->cart->products->pivot->insert([
                'cart_id' => $this->cart->id,
                'product_id' => $product_id,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return true;
        }
    }

    public function increament($product_id){
        $product = $this->cart->products->find($product_id);


        if( $product->pivot->quantity < $product->available_qte  ){
            $product->pivot->quantity++;
            $product->available_qte--;

            $product->pivot->save();
            $product->save();

            return true;
        }


        return false;
    }

    public function decreament($product_id){
        $product = $this->cart->products->find($product_id);


        if( $product->pivot->quantity > 1  ){
            $product->pivot->quantity--;
            $product->available_qte++;

            $product->pivot->save();
            $product->save();

            return true;
        }


        return false;
    }

    public function remove($product_id){
        $record = $this->cart->pivot->where("product_id", "=", $product_id)->get()->first();
        $record->pivot->remove();
        return true;
    }

}