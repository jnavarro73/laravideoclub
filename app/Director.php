<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
        public $timestamps = false;
	public function movies() {
	    //return $this->belongsToMany('App\Movie');
	    return $this->hasMany('App\Movie');
	}
}
