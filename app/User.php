<?php

namespace App;

use DateTime;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', "email_phone", 'password', "gender", "birthday", "location",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];


    protected $dates = [
        'created_at',
    ];

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstName} {$this->lastName}";
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function age()
    {
        $birthday = new DateTime($this->birthday);
        $age = $birthday->diff(new DateTime('now'))->y;
        return $age;
    }


    /**
     * Get all of the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany('App\Post', "user_id", "id");
    }

    public function devices()
    {
        return $this->hasMany('App\Device', "user_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function location()
    {
        return $this->hasOne('App\Location', "id", "id");
    }
}
