<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Movie extends Model
{
	
			
  public static function getMovies(){
	
	$oMovies=DB::table('movies')->orderBy('id', 'asc')->get()->toArray();
	return $oMovies;
  
  } 

  
  
  /**
  public static function getMovie($id){
  	// findOrFail
  	// $movie = DB::table('movies')->where('id', '=', $id)->findOrFail();
  	   return $movie;
  }*/

}