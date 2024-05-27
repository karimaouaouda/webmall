<?php

namespace App\Models;

use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "path",
        "primary"
    ];


    public function product(){
        return $this->belongsTo(Product::class);
    }
}
