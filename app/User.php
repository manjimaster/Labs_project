<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        // return $this->belongsToMany('App\Role','roles_users', 'user_id','role_id');
        return $this->belongsTo('App\Role');
    }

    public function users_images()
    {
        return $this->belongsTo('App\UsersImage');
    }

    public function positions()
    {
        return $this->belongsTo('App\Position', 'positions_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
