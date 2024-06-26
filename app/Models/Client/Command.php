<?php

namespace App\Models\Client;

use App\Models\Auth\Client;
use App\Models\Shipping\ShippingMethod;
use App\Models\Shop;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'shop_unique_name',
        'tracking_code',
        'shipping_with',
        'ship_to',
        'status',
    ];


    protected $casts = [
        'ship_to' => 'array'
    ];

    public function getNumberAttribute(){
        return $this->id;
    }


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_unique_name');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'commands_products');
    }


    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_with');
    }
}
