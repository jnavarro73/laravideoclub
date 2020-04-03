<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

//
use App\Events\IntroducidaNuevaPeliculaSinVer;
use App\Listeners\NotificacionNovedad;

class EventServiceProvider extends ServiceProvider
{


    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class ,
        ],
        IntroducidaNuevaPeliculaSinVer::class =>[
            NotificacionNovedad::class ,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

    //esto hace que busque directamente en la lista de listeners si alguno esta asociado
    //a este evento. subtitule a poner en la lista de $listen,
    //OJO si está a true y está en lista lanza el evento 2 veces

    public function shouldDiscoverevents(){
        //return true;
    }
}
