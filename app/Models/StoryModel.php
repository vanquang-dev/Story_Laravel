<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class StoryModel extends Model implements Searchable
{
    // Ket noi database
    public $table = "story";
    public $timestamps = false;
    public $fillable = [
        'id',
        'story_name',
        'description',
        'image',
        'status'
    ];

    public function getSearchResult(): SearchResult
    {
        
        $url = route('all-story', $this->id);

        return new SearchResult(
            $this,
            $this->story_name,
            $url
        );
    }
    public function Category()
    {
        return $this->belongsToMany('App\Models\CategoryModel','story_category' ,'story_id', 'category_id');
    }
    
}
