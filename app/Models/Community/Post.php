<?php

namespace App\Models\Community;

use App\Community\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'publisher_id'
    ];



    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
