<?php

namespace App\Models\Setup;

use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'name';

    protected $keyType = 'string';

    public $incrementing = false;


    protected $fillable = [
        'category_name',
        'name'
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_name');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'sub_category_name');
    }
}
