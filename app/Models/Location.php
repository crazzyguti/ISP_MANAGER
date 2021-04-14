<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = "locations";
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo("App\Models\User","id","id");
    }

    /**
     * Get all of the post's comments.
     */
    public function markers()
    {

        return $this->hasMany('App\Models\Marker',"id","id");
    }
}
