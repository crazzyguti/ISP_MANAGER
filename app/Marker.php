<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = "markers";
    protected $guarded = [];

    public function markers()
    {
        return $this->belongsToMany('App\Marker', 'location_marker', 'location_id', 'id');
    }

}
