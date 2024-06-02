<?php

namespace App\Models\Setup;

use App\Models\Auth\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Identity extends Model
{
    use HasFactory;


    protected $fillable = [
        'Identifiable_type',
        'Identifiable_id',
        'id_path',
        'status'
    ];



    public function identifiable(): MorphTo
    {
        return $this->morphTo();
    }


    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'processed_by');
    }
}
