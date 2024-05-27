<?php

namespace App\Models;

use App\Enums\ShopStatus;
use App\Models\Auth\Client;
use App\Models\Auth\Seller;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $primaryKey = 'unique_name';

    protected $keyType = 'string';

    public $incrementing = false;



    protected $fillable = [
        'seller_id',
        'unique_name',
        'name',
        'description',
        'logo',
        'cover',
        'status',
        'reason'
    ];


    public function getAcceptedAttribute(){
        return $this->status == ShopStatus::Accepted;
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'shops_followers');
    }



    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'shop_unique_name', 'unique_name' );
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
