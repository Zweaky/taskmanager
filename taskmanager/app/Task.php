<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function team()
    {
    	return $this->belongsTo('App\Team');
    }

    protected $fillable = [
        'description', 'status', 'starttime', 'endtime','public','user_id','team_id'
    ];
}
