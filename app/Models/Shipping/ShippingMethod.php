<?php

namespace App\Models\Shipping;

use App\Models\Client\Command;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $primaryKey = 'company_name';

    public $incrementing = false;

    protected $fillable = [
        'company_name',
        'description',
    ];

    public function commands(): HasMany
    {
        return $this->hasMany(Command::class);
    }
}
