<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Movie;

class NuevaPeliserieSinVerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data;

    public function __construct(Movie $nuevapeli )
    { //dd($nuevapeli);
        $this->data = $nuevapeli; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        //return $this->view('view.name');
        
          return $this->from('3a36f05df6-28eced@inbox.mailtrap.io', 'Mailtrap')
            ->subject('Nueva peli o serie q no has visto')
            ->markdown('mails.exmpl')
            ->with([
                'name' => $this->data->title,
                'link' => 'LINNNNKKK'
            ]);


    }
}
