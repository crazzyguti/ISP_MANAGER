<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $guarded = [];


    public function post()
    {
        return $this->morphMany('App\Post', 'category');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
}


