<?php

namespace App\Models\Shipping;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected  $primaryKey = "tracking_code";

    protected $keyType = "string";

    public $incrementing = false;



    protected $fillable = [
        'tracking_code',
        'status'
    ];
}
