<?php

use Illuminate\Database\Seeder;
use App\Director;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $arrayDirectors = array('Desconocido',
    	'Francis Ford Coppola',
    	'Steven Spielberg',
    	'Quentin Tarantino',
    	'Frank Darabont',
    	'George Roy Hill',
    	'Roberto Benigni',
    	'Martin Scorsese',
    	'Milos Forman', 
    	'Tony Kaye', 
    	'Clint Eastwood',
    	'Brian De Palma',
    	'Roman Polanski',
    	'David Fincher',
    	'Jonathan Demme',
    	'Stanley Kubrick',
    	'Ridley Scott', 
    	'David Fincher');

    public function run()
    {
		DB::table('directors')->delete();

    	foreach( $this->arrayDirectors as $director ) {
			$p = new Director;
			$p->name = $director;
			$p->save();
		}	
		
    }
}
