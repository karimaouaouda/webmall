<?php

namespace App\Models\Shop;

use App\Models\Auth\Admin;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $table = 'shops_documents';

    protected $fillable = [
        'shop_unique_name',
        'document',
        'serial_number',
        'starts_at',
        'status',
        'processed_by',
        'admin_note'
    ];


    protected $casts = [
        'starts_at' => 'datetime',
    ];


    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_unique_name');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'processed_by');
    }
}
