<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $aCategorias = array();
        $aCategorias[]= array("categoria"=>"ciencia ficcion","level"=>1);
        $aCategorias[]= array("categoria"=>"fantasia","level"=>1);
        $aCategorias[]= array("categoria"=>"drama","level"=>1);
        $aCategorias[]= array("categoria"=>"costumbrista","level"=>1);
        $aCategorias[]= array("categoria"=>"documental","level"=>1);
        $aCategorias[]= array("categoria"=>"comedia","level"=>1);
        $aCategorias[]= array("categoria"=>"terror","level"=>1);
        $aCategorias[]= array("categoria"=>"western","level"=>1);
        $aCategorias[]= array("categoria"=>"medieval","level"=>1);
        $aCategorias[]= array("categoria"=>"policial","level"=>1);
        $aCategorias[]= array("categoria"=>"thriller","level"=>1);
        $aCategorias[]= array("categoria"=>"varios","level"=>1);

      foreach ($aCategorias as $key => $value) {
      	$p = new Categoria;
      	$p->level = $value['level'];
      	$p->categoria = $value['categoria'];

      	$p->save();
      }
    }
}
