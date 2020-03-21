<?php
namespace App\Http\Controllers;
//Symfony\Component\Console\Input\Input
//require $_SERVER['document_root'].'/vendor/autoload.php';

use App\Movie;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
//require Carbon\Carbon;
use Carbon\Carbon;
use App\Product; 
use Faker\Generator as Faker; 
class CatalogController extends Controller
{
    
    public function getIndex()
	{ 
		$arrayPeliculas = Movie::getMovies();
		//usando ORM
		$arrayPeliculas = Movie::paginate(6);
		//TODO no necesito pasarlo a json por?
		//dd($this->arrayPeliculas);
		//dd($arrayPeliculas);
		//dd($this->arrayPeliculas);
		return view('catalog.index', array('arrayPeliculas'=>$arrayPeliculas));
	}

    public function getShow($id)
	{

		//$aPelicula = Movie::getMovie($id);
		//$aPelicula = Movie::find($id);
		$aPelicula = Movie::findOrFail($id)->toArray();
		//dd($aPelicula);
		
		// Logica decidir si cojo loreips o directamente imagen
		// y meter en urlimagenposter
		/*
			if (!empty(strstr($aPelicula->poster,"http"))){$aPelicula->urlimagenposter = $aPelicula->poster;}
			else {$aPelicula->urlimagenposter = "/images/".$aPelicula->poster;}
		*/

			//$aPelicula->urlimagenposter = $aPelicula->poster;
		return view('catalog.show', array('oPelicula'=>$aPelicula));
	}

	public function getEdit($id)
	{	 $aPelicula = Movie::findOrFail($id)->toArray();
		 
		//$current = Carbon::now();
		//$current = new Carbon();

		// get today - 2015-12-19 00:00:00
		//$today = Carbon::today();
		//dd($today);

		 $fecha_actual = Carbon::now();
		 $anyoActual = $fecha_actual->year;
		//		 dd($anyoActual);
		return view('catalog.edit', array('oPelicula'=>$aPelicula,
			'anyoActual'=>$anyoActual));
	}

	public function getCreate()
	{
		 $fecha_actual = Carbon::now();
		 $anyoActual = $fecha_actual->year;
		
		return view('catalog.create', array('anyoActual'=>$anyoActual));
	}

	public function putCreate(Request $request){
		
		$nuevaPelicula = new Movie;
        // Validate the request...
		/*
        $flight = new Flight;
        $flight->name = $request->name;
        $flight->save();
        */
      // TODO dice que no existe Input; debe ser pk no existe Form::  
      // $file = Input::Hasfile('imagen');
        $file = $request->imagen;
       //dd($file);
        if(!empty($file)){
        	$sFichero = time().'-'.$file->getClientOriginalName();
        	$file->move(public_path('').'/images/'.$sFichero);
        	$nuevaPelicula->poster = $sFichero;
        
        }else {
        	// getPoster (api externa)
        	// or
        	// lore ips
        }

        $nuevaPelicula->title    = $request->title;
        $nuevaPelicula->director = $request->director;
        $nuevaPelicula->synopsis = $request->synopsis;
        $nuevaPelicula->year     = $request->year;
        
        //dd($nuevaPelicula);
        
        //validation
 		
     	$request->validate([
			        'title' 	=> 	'required|max:255',
			        'director'	=>	'required',
			        'synopsis' 	=> 	'required',
			        'year' 		=> 	'required|numeric|min:1900'
    			]);
     	
        $nuevaPelicula->save();
      // dd('kk');
       return redirect('/catalog/');
    }
	
	public function putEdit(Request $request,$id){
		//dd('putEdit');
		//dd($request);
		//$id = $request->input('id');
		//dd($id);
		$aPelicula = Movie::findOrFail($id);
    
        // Validate the request...
		/*
	        $flight = new Flight;
	        $flight->name = $request->name;
	        $flight->save();
        */
       
        $aPelicula->title = $request->title;
        $aPelicula->director = $request->director;
        $aPelicula->synopsis= $request->synopsis;
        $aPelicula->year = $request->year;

        $aPelicula->update();

        return redirect('/catalog');
       
	}
	/**
	TODO
	*/
	public function getPoster(Request $request,$id){
		$aPelicula = Movie::findOrFail($id);
		//$client = new \GuzzleHttp\Client();
		$client = new \GuzzleHttp\Client(array("https://api.themoviedb.org/"));
		//dd($client);
		$res = $client->get("search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query=".$aPelicula->title);
		dd($res);
		//$res= $client->require("GET","https://api.themoviedb.org/3/search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query=".$aPelicula->title);
		dd($res);
	}
	//Via API
	public function putEditAPI(Request $request,$id){

	}
	public function destroyFilm(Request $request, $id){
		//dd('delete');
		Movie::find($id)->delete();
		return redirect('/catalog');
	}

}
