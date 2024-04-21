<?php

namespace App\Models\Shipping;

use App\Models\Client\Command;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;


    protected $fillable = [

    ];

    public function commands(){
        return $this->hasMany(Command::class);
    }
}
