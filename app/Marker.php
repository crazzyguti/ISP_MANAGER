<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = "markers";
    protected $guarded = [];

    /**
     * Get the post that owns the comment.
     */
    public function locates()
    {
        return $this->belongsTo('App\Location');
    }

}
