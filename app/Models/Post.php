<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    protected $fillable = [
        'name', 'description','image_path',
    ];

    protected $with = [
        'tag'
    ];

    function tag(){
        return $this->belongsTo(Tag::class);
    }
}
