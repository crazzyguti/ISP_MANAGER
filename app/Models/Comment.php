<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = "comments";
    protected $guarded = [];

    protected $fillable = [];

    protected $primaryKey = 'id';
    

 


    public function commentable()
    {
        return $this->morphTo();
    }



}
