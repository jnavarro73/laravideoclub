<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Movies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        /**
        id Autoincremental
        title String
        year String de longitud 8
        director String de longitud 64
        poster String
        rented Booleano
        synopsis Text
        timestamps Timestamps de Eloquent

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email',60)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',6);
            $table->rememberToken();
            $table->timestamps();
        */
        Schema::create('movies', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('year',8);
        
            $table->string('poster');
            $table->boolean('vista')->default(false);
            $table->text('synopsis');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('director_id');
            $table->foreign('director_id')->references('id')->on('directors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
