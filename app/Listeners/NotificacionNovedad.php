<?php

namespace App\Listeners;

use App\Events\IntroducidaNuevaPeliculaSinVer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\NuevaPeliserieSinVerMail;
use Illuminate\Support\Facades\Mail;

class NotificacionNovedad
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       // dd('construct de NotificacionNovedad');
    }

    /**
     * Handle the event.
     *
     * @param  IntroducidaNuevaPeliculaSinVer  $event
     * @return void
     */
    public function handle(IntroducidaNuevaPeliculaSinVer $event)
    {
       //var_dump('Listener act');
        //dd($event);
           Mail::to('jacs.jacin@gmail.com')->send(new NuevaPeliserieSinVerMail($event->nuevapelicula)); 
        
    return 'A message has been sent to Mailtrap!';
    }
}
