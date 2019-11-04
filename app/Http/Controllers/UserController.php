<?php
/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
}
*/
namespace App\Http\Controllers;


use DB;
use App\Http\Controllers\Controller;

class UserController extends Controller {

    /** * Show a list of all of the application’s users. * * @return Response */

    public function index() {

        //$users = DB::table(‘usuarios’)->get();
        $users = DB::table('actor')->get();
        dd($users);
    }
}
