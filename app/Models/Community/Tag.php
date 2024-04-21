<?php

namespace App\Community\Models;

use App\Models\Community\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'word'
    ];

    public function pousts(){
        return $this->belongsToMany(Post::class);
    }
}
