<?php

use Illuminate\Database\Seeder;

class fakeposterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /**
    * Fake Poster Seed
    */
    public function seedFakePosters(){
    	
    }

    /**
    */
    public function run()
    {
        self::seedFakePosters();
		$this->command->info('Imagenes de posters fake puestos!');
    }
}
