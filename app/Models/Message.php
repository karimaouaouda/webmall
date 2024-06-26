<?php

namespace App\Models;

use App\Models\Auth\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        "client_id",
        "content",
        "gpt_response"
    ];



    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
