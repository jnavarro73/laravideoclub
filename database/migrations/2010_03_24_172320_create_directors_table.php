<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   /*
        Schema::create('director_movie', function (Blueprint $table) {
            $table->integer('movie_id')->unsigned();
            $table->integer('director_id')->unsigned();
           
            $table->unique(array('director_id', 'movie_id'));
            
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('director_id')->references('id')->on('directors')->onDelete('cascade');

            
       
        */
        Schema::create('directors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',64);
           
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           Schema::dropIfExists('directors');
    }
}
