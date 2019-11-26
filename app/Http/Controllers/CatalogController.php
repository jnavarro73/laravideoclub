<?php
namespace App\Http\Controllers;

//require $_SERVER['document_root'].'/vendor/autoload.php';

use App\Movie;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
//require Carbon\Carbon;
use Carbon\Carbon;

class CatalogController extends Controller
{
    
    public function getIndex()
	{ 
		$arrayPeliculas = Movie::getMovies();
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
		return view('catalog.create');
	}
	public function postCreate(Request $request){
		$nuevaPelicula = new Movie;
		
    
        // Validate the request...
		/*
        $flight = new Flight;

        $flight->name = $request->name;

        $flight->save();
        */
        $nuevaPelicula->title = $request->title;
        $nuevaPelicula->synopsis= $request->synopsys;
        $nuevaPelicula->save();
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
        $aPelicula->synopsis= $request->synopsis;
        $aPelicula->year = $request->year;
        $aPelicula->update();
        return redirect('/catalog');
       
	}
}
