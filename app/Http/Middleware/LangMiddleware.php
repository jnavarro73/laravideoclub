<?php

namespace App\Http\Middleware;
use App;
use Closure;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LangMiddleware 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function handle($request, Closure $next)
    {
        //dd(Session::get('lang').'--'.Config::get('app.languages'));
        if (Session::has('lang')) {
            App::setLocale(Session::get('lang'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
        
        return $next($request);
    }
}
