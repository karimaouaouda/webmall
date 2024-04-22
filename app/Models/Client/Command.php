<?php

namespace App\Models\Client;

use App\Models\Auth\Client;
use App\Models\Shipping\ShippingMethod;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'payment_method',
    ];

    public function getNumberAttribute(){
        return $this->id;
    }


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'commands_products');
    }


    public function shippingMethod(){
        return $this->belongsTo(ShippingMethod::class);
    }
}
