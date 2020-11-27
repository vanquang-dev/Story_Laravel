<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    //
    public $table = "admin";
    public $timestamps = false;
    public $fillable = [
        'id',
        'username',
        'password',
        'kind'
    ];
}
