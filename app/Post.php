<?php

namespace App;

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
        return $this->belongsTo('App\Category', 'posts');
    }

    public function user()
    {
        return $this->belongsTo("App\User","id","user");
    }

     /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
