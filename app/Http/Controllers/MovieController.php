<?php
namespace App\Http\Controllers;
//Symfony\Component\Console\Input\Input
//require $_SERVER['document_root'].'/vendor/autoload.php';

use App\Movie;
use App\Director;
use App\Categoria;
use App\Events\IntroducidaNuevaPeliculaSinVer;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
//require Carbon\Carbon;
use Carbon\Carbon;
use App\Product; 
use Faker\Generator as Faker;
use App\User;
use App\Notifications\MovieUpdated;
use App;
//TODO dicen q hay peligro de usar muchas facades
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redis;
//harcodeado para tener $user autenticado
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    
    public function getIndex(Request $request)
	{ 

		//dd($request->session());

		
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
		//$aPelicula = Movie::findOrFail($id)->toArray();
		$aPelicula = Movie::findOrFail($id);
		//$aPelicula->categoria = $aPelicula->categoria();
		//dd($aPelicula);
		$visibility = Storage::getVisibility($aPelicula->poster);
		Storage::setVisibility($aPelicula->poster,'public');
		dd($visibility);
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
	{	 
		$aPelicula = Movie::findOrFail($id)->toArray();
		//$locale = App::getLocale();
		//var_dump($locale);

		//$current = Carbon::now();
		//$current = new Carbon();

		// get today - 2015-12-19 00:00:00
		//$today = Carbon::today();
		//dd($today);

		//traer lista de directores
		
		//Traer y meter en cache --- si ha pasado una hora --- la lista de directores.
		$listaDirectores = cache()->remember('listadirectores', 3600, function () {
		  
		    $oDirectores = Director::all();
			
			foreach ($oDirectores as $key => $value) {
				$aDirectores[] = $value->name;
			};
			return $aDirectores;
		});

//Redis::set('lista_directores', $aDirectores);

//dd($listaDirectores);

//$valueCache = cache('listadirectores');
//dd($listaDirectores);

		 $aPelicula['director']  = Director::findOrFail($aPelicula['director_id'])->name;
		 $aPelicula['categoria'] = Director::findOrFail($aPelicula['category_id'])->categoria;
		 $fecha_actual = Carbon::now();
		 $anyoActual = $fecha_actual->year;
		 // por hacer arbol categorias - subcategorias
		 $breadcrum_categorias = "";
		//		 dd($anyoActual);
		return view('catalog.edit', 
					array('oPelicula'=>$aPelicula, 
						  $breadcrum_categorias,
						  'anyoActual'=>$anyoActual));
	}

	public function getCreate()
	{
		 $fecha_actual = Carbon::now();
		 $anyoActual = $fecha_actual->year;
		 //$valueCache = cache('lista_directores');
		//dd($valueCache);
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
    	
        if(!empty($file)){
        	 

    // Generate a file name with extension
    $fileName = 'profile-'.time().'.'.$file->getClientOriginalExtension();

    // Save the file
    $path = $file->storeAs('images', $fileName);
        $nuevaPelicula->poster = $fileName;
        }else {
        	// getPoster (api externa)
        	// or
        	// lore ips
        }


        // $nuevaPelicula->director = $request->director;
        //$nuevaPelicula->director_id = $request->director;
        
        $nuevaPelicula->title       = $request->title;
        $nuevaPelicula->director_id = 1;
        $nuevaPelicula->category_id = 1;
        $nuevaPelicula->vista 		= false;
        $nuevaPelicula->poster   	= $nuevaPelicula->poster;
        $nuevaPelicula->synopsis 	= $request->synopsis;
        $nuevaPelicula->year     	= $request->year;
     	
        //dd($nuevaPelicula);
        
        //validation
 		
     	$request->validate([
			        'title' 		=> 	'required|max:255',
			        //'director_id'	=>	'required',
			        //'category_id'	=>	'required',
			        'synopsis' 		=> 	'required',
			        'year' 			=> 	'required|numeric|min:1900',
			        //'vista'			=>  'required'
    			]);
     	
        $nuevaPelicula->save();
      // dd('kk');

        //EVENTO QUE ENVIA MAIL SI ES NOVEDAD 
      //  var_dump($nuevaPelicula);
        if($nuevaPelicula->vista == false){
        	IntroducidaNuevaPeliculaSinVer::dispatch($nuevaPelicula);
        	//event(new IntroducidaNuevaPeliculaSinVer($nuevaPelicula->title));
        }

       return redirect('/catalog/');
    }
	
	public function putEdit(Request $request,$id){
		//dd('putEdit');
		//dd($request);
		//$id = $request->input('id');
		//dd($id);
		



		$aPelicula = Movie::findOrFail($id);
		//miramos si hay permiso 
		$this->authorize('update',$aPelicula);


    
        // Validate the request...
		/*
	        $flight = new Flight;
	        $flight->name = $request->name;
	        $flight->save();
        */
       
	        // gestion image 
	  $file = $request->imagen;

	if(!empty($file)){
        	 
	//	dd($file);
    // Generate a file name with extension
    $fileName = 'profile-'.time().'.'.$file->getClientOriginalExtension();
//dd($fileName);
    // Save the file
    $path = $file->storeAs('images', $fileName);
    $aPelicula->poster = $fileName;
    }else {
    	//dd($file);
        	// getPoster (api externa)
        	// or
        	// lore ips
    }
//TODO la imagen antigua borrarla o 
//montar una tabla imagenes, una de cruce movie-imagen con un campo activo. 



        $aPelicula->title = $request->title;
        //$aPelicula->director = $request->director;
        //TODO  HARDCODED QUE POR LO VISTO no se lo traga
        $request->director_id   = 1;
        $request->category_id   = 1;
        $aPelicula->director_id = $request->director_id;
        $aPelicula->category_id = $request->category_id;
        $aPelicula->director_id = 1;
        $aPelicula->category_id = 1;
        $aPelicula->synopsis    = $request->synopsis;
        $aPelicula->year        = $request->year;
//dd($request);

        	$request->validate([
			        'title' 		=> 	'required|max:255',
			       //'director_id'	=>	'required',
			       // 'category_id'	=>	'required',
			        'synopsis' 		=> 	'required',
			        'year' 			=> 	'required|numeric|min:1900'
    			]);

        $aPelicula->update();




        // Si llego aqui es pk ha conseguido hacer el update sin error.
        // Enviar una NOTIFICACION por ejemplo

        //$user->notify(new InvoicePaid($invoice));
        $users = User::all();
        //facade way:
        Notification::send($users, new MovieUpdated($aPelicula));
        /*
        foreach ($users as $user) {
        	$user->notify(new MovieUpdated($aPelicula));
        	# code...
        }*/
        
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
