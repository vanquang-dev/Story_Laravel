<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story_Category extends Model
{
    //
    public $table = "story_category";
    public $fillable = [
        'story_id',
        'category_id'
    ];
}
