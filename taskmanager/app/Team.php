<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    protected $fillable = [
        'name', 'description', 'public',
    ];
}
