<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $guarded = [];


    /**
     * Get all of the post's category.
     */
    protected function category()
    {
        return $this->belongsTo('App\Models\Category', 'posts');
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User","id","user");
    }

     /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
