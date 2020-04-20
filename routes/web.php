<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
use Carbon\Carbon;
Route::get('/usuarios', 'UserController@index');


Route::get('/saludo', function () {

$current = Carbon::now();
$current = new Carbon();

// get today - 2015-12-19 00:00:00
$today = Carbon::today();
dd($today);
    return "Esta es una ruta en laravel /saludo";
});
/*
Route::get('saludo', function () {
    return "Esta es una ruta en laravel saludo";
});
*/
/*
/ Pantalla principal
login Login usuario
logout Logout usuario
catalog Listado películas
catalog/show/{id} Vista detalle película {id}
catalog/create Añadir película
catalog/edit/{id} Modificar película {id}
*/
//Route::get("/home",'HomeController@index');


//Route::get("login",'AuthController@index');
//Route::get("logout",'LoginController@index');


Auth::routes();
Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles','RoleController');

    Route::resource('users','UserController');

    //Route::resource('products','ProductController');

});

Route::get('/home', 'HomeController@index')->name('home');

// RUTA para pode detectar idioma y si es ingles, que tambien aparezca
// porque el locale que tengo en app.php
// 'locale' => 'es',

Route::group(['middleware' => ['lenguaje']], function() {
	
	Route::get("/",'MovieController@getIndex');
	Route::get("/catalog",'MovieController@getIndex');
	/*Route::get('/catalog', function(){
		return view('catalog.index','MovieController@getIndex');

	});
	*/
	Route::get("/catalog/show/{id}",'MovieController@getShow');
	Route::get("/catalog/create",'MovieController@getCreate');
	Route::get("/catalog/edit/{id}",'MovieController@getEdit');

	Route::put("/catalog/create",'MovieController@putCreate');
	Route::put("/catalog/edit/{id}",'MovieController@putEdit');
	/* para hacer delete no puedo llegar de url get */
	/* esta es un closure */
	/*
	Route::delete('/catalog/borrar/{id}', function(){
		//código a ejecutar cuando se produzca esa rutay el verbo DELETE
		//return 'delete';
		dd('route delete');
	});
	*/
	Route::delete("/catalog/borrar/{id}",'MovieController@destroyFilm');
	Route::get("/catalog/poster/{id}",'MovieController@getPoster');
});
Route::get("/pruebasTests",function(){
	class MyException extends Exception {}

	try {
		throw new MyException('Oops!');
	} catch (Exception $e) {
	echo "Caught Exceptionn";
	} catch (MyException $e) {
	echo "Caught MyExceptionn";
	}
});


/*
 /api/v1/catalog/{id}/rent   PUT auth.basic.once APIMovieController@putRent
 /api/v1/catalog/{id}/return PUT auth.basic.once APIMovieController@putReturn
Route::put($uri, $callback);
Route::get('user/profile/{id}', function($id)
{
$user = // Cargar los datos del usuario a partir de $id
return view('user.profile', array('user' => $user));
});

Route::get('user/profile/{id}', function($id)
{
$user = // Cargar los datos del usuario a partir de $id
return view('user.profile', array('user' => $user));
});
*/
/*
Route::get('/images/{attachment}',function($attachment){
		dd('pide'.$attachment);
})->name('displayImage');
*/
Route::get('/images/{attachment}',function($attachment){
	//dd('pide'.$attachment);
	//$file = sprintf('app/%s',$attachment);
	
	/*
	
	if (File::exists($file)){
		return \Intervention\Image\Facades\Image::make('/images/'.$attachment);
	}
	   'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
	sitio real que guardo imagen:
	$path = $request->file('imagen')->store('images');
	guardo el path en bd: "images/laquesea.jpg"
	ruta real:
	www/html/miislaprohibida/storage/app/imageslaquesea.jpg#

	tras php artisan storage:link mis paths son:

	var_dump(storage_path());
	var_dump(public_path());


	string(37) "/var/www/html/miislaprohibida/storage" 
	string(36) "/var/www/html/miislaprohibida/public" 
	'links' => [
    	public_path('storage') => storage_path('app/public'),
    	public_path('images') => storage_path('app/images'),
	],
	Esto hace : public/storage to storage/app/public

	
	dd($file);
	*/
	$path = storage_path('app/images/'.$attachment);
	// dd($path);
	 if (!File::exists($path)) {

        abort(404);

    }



    $file = File::get($path);
//var_dump($file);
    $type = File::mimeType($path);

//var_dump($type);

    $response = Response::make($file, 200);

    $response->header("Content-Type", $type);


//dd($response);
    return $response;
})->name('displayImage');;
	
Route::get('welcome/{locale}', function ($locale) {
//    App::setLocale($locale);
});

Auth::routes();

 Route::get('/home', 'HomeController@index')->name('home');

 Route::get('/lang/{lang}', function ($lang) {
 	//echo"lang es ".$lang;
 	//dd(session());
    session(['lang' => $lang]);
   // dd('locale en route lang:'.App::getLocale());
    return \Redirect::back();
    })->where([
        'lang' => 'en|es'
 ])->middleware('lenguaje');

    //Route::get('logout','');