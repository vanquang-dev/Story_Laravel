<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter_Story extends Model
{
    //
    public $table = "chapter_story";
    public $timestamps = false;
    public $fillable = [
        'story_id',
        'chapter',
        'title',
        'detail_story'
    ];
}
