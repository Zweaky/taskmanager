<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Task;
use App\Team;

class User extends Authenticatable
{
    use Notifiable;

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function teams()
    {
        return $this->hasMany('App\Team');
    }
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
}
