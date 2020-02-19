<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterValoracionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {    /* 
        Schema::table('valoraciones', function (Blueprint $table) {

            $table->renameColumn('8', 'valoracion');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()

    {
        /*
        Schema::table('valoraciones', function (Blueprint $table) {
           $table->renameColumn( 'valoracion','8');
        });
         */

    }
}
