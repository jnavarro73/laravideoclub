<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
//use Illuminate\Notifications\Notifiable;
class Movie extends Model
{
	
 // si quisiese poner otra tabla tendría que hacer esto:
 // protected $table = 'my_flights';	
 // Porque por defecto el nombre del objeto con inicial mayuscula 
 // pasa a ser el nombre de la tabla en plural
 // Y la primary key tambien tendría que cambiar
 // protected $primaryKey = 'flight_id';
  /*
  public static function getMovie(){

  }
*/
 //use Notifiable;
  //TODO y pk no Movie::all();
  public static function getMovies(){
	
  	$oMovies=DB::table('movies')->orderBy('id', 'asc')->get()->toArray();
  	return $oMovies;
  
  } 

  public function directors() {
    return $this->belongsTo('App\Director');
    //return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
  }
 //TODO REpasar pk static y como hace el findOrFail , como pasar id director aquí con self o no.
  public function getDirectorName(){
    $results = DB::select('select name from  directors where id = :id', ['id' => $this->director_id]);
    return $results['name'];
  }

  public function categoria(){
   //return $this->belongsTo(Categoria::class);
     return $this->belongsTo('App\Categoria');
  }
  
  
  /**
  public static function getMovie($id){
  	// findOrFail
  	// $movie = DB::table('movies')->where('id', '=', $id)->findOrFail();
  	   return $movie;
  }*/

}