<?php

namespace App\Events;


use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Movie;

class IntroducidaNuevaPeliculaSinVer
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $nuevapelicula;

    public function __construct(Movie $nuevapelicula )
    {
        //echo __CLASS__;
        $this->nuevapelicula = $nuevapelicula;
       // dd('evento'.__CLASS__);
    }

   
}
