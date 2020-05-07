<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $guarded = [];


    public function post()
    {
        return $this->belongsTo('App\Post', 'category_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id');
    }
}


