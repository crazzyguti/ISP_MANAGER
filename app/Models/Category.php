<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $guarded = [];


    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'category_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id');
    }
}


