<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Ban extends Model
{
    use HasFactory;

    public function bannable(): MorphTo
    {
        return $this->morphTo();
    }
}
