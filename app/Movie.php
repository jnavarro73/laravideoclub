<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

  public static function getMovies(){
	$oMovies=DB::table('movies')->orderBy('id', 'asc')->get();
	return $oMovies;
  }
}