<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'sub_category_name'
    ];



    public function clients(){

    }
}
