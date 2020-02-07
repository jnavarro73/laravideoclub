<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
	
//si quisiese poner otra tabla tendría que hacer esto:
// protected $table = 'my_flights';	
// Porque por defecto el nombre del objeto con inicial mayuscula 
//pasa a ser el nombre de la tabla en plural
	// Y la primary key tambien tendría que cambiar
	//protected $primaryKey = 'flight_id';

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