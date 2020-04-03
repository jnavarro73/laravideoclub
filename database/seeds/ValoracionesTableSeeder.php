<?php

use Illuminate\Database\Seeder;

class ValoracionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO y si el id es el de la pelicula
        // No tengo el campo
        DB::table('valoraciones')->delete();
        factory('App\Valoracion',50)->create();
    }
}
