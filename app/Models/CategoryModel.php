<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    // Ket noi database
    public $table = "category";
    public $timestamps = false;
    public $fillable = [
        'id',
        'category_name'
    ];
}
