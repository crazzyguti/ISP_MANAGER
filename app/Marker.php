<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = "markers";
    protected $guarded = [];

    public function markerable()
    {
        return $this->morphTo();
    }

}
