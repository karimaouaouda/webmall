<?php

namespace App\Models\Shop;

use App\Events\ProductRunningOut;
use App\Models\Client\Command;
use App\Models\Setup\SubCategory;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Karimaouaouda\LaravelRater\Ratable;
use Karimaouaouda\LaravelRater\Traits\CanBeRated;

class Product extends Model implements Ratable
{
    use HasFactory;
    use CanBeRated;

    protected $fillable = [
        'sub_category_name',
        'shop_unique_name',
        'slug',
        'description',
        'available_qte',
        'price',
        'welcome_solde',
        'solde',
        'images',
        'sensitive_qte',
        'tags',
        'options'
    ];


    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'options' => 'array'
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


    public function getPriceAfterSoldeAttribute(){
        return $this->price * (1 - $this->solde / 100);
    }


    public function shop(){
        return $this->belongsTo(Shop::class,
                            'shop_unique_name',
                            'unique_name');
    }


    public function subCategory(): BelongsTo
    {
        return $this->BelongsTo(SubCategory::class, 'sub_category_name');
    }


    public function commands(): BelongsToMany
    {
        return $this->belongsToMany(Command::class, 'commands_products');
    }
}
