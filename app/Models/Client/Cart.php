<?php

namespace App\Models\Client;

use App\Models\Auth\Client;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


    protected $fillable = [
        'client_id',
    ];


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function items(){
        return $this->belongsToMany(Product::class, 'cart_items');
    }

}
