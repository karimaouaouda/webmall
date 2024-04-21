<?php

namespace App\Models;

use App\Models\Auth\Seller;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];





    public function products(){
        return $this->hasMany(Product::class, 'shop_unique_name', 'unique_name' );
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
