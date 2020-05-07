<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $guarded = [];


    public function commentable()
    {
        return $this->morphTo();
    }
}
