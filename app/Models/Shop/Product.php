<?php

namespace App\Models\Shop;

use App\Events\ProductRunningOut;
use App\Models\Setup\SubCategory;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_id',
        'shop_unique_name',
        'slug',
        'description',
        'available_qte',
        'price',
        'welcome_solde',
        'solde',
        'sensitive_qte'
    ]; 


    public function increamentQte(int $count){
        if( $this->available_qte < $count ){
            throw new \Exception("not good bro");
        }

        $this->available_qte -= $count;

        if( $this->sensitive_qte >= $this->available_qte ){
            event(new ProductRunningOut($this));
        }


        return true;
    }


    public function shop(){
        return $this->belongsTo(Shop::class,
                            'shop_unique_name',
                            'unique_name');
    }


    public function subCategory(){
        return $this->BelongsTo(SubCategory::class);
    }



}
