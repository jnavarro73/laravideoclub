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
Route::get("/home",'HomeController@index');
Route::get("/",'HomeController@getHome');
//Route::get("login",'AuthController@index');
//Route::get("logout",'LoginController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get("/catalog",'CatalogController@getIndex');
/*Route::get('/catalog', function(){
	return view('catalog.index','CatalogController@getIndex');

});
*/
Route::get("/catalog/show/{id}",'CatalogController@getShow');
Route::get("/catalog/create",'CatalogController@getCreate');
Route::get("/catalog/edit/{id}",'CatalogController@getEdit');

Route::post("/catalog/create",'CatalogController@postCreate');
Route::put("/catalog/edit/{id}",'CatalogController@putEdit');
/*
Route::put($uri, $callback);
*/
/*
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