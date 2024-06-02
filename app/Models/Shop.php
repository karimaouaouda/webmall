<?php

namespace App\Models;

use App\Enums\ShopStatus;
use App\Models\Auth\Client;
use App\Models\Auth\Seller;
use App\Models\Shop\Document;
use App\Models\Shop\Product;
use App\Traits\HasAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Karimaouaouda\LaravelRater\Traits\CanBeRated;

class Shop extends Model
{
    use HasFactory;
    use HasAddress;
    use CanBeRated;

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
        'serial_number',
        'start_at',
        'agreement',
        'status'
    ];

    protected $casts = [
      'start_at' =>  'datetime'
    ];

    public function isPublished() : bool
    {
        return $this->document->status == ShopStatus::Accepted->value;
    }

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

    public function document(): HasOne
    {
        return $this->hasOne(Document::class, 'shop_unique_name');
    }
}
