<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'name';

    public $incrementing = false;

    protected $keyType = 'string';



    protected $fillable = [
        'name'
    ];


    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category_name');
    }
}
