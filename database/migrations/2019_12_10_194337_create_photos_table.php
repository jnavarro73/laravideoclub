<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('filepath_imagen',8);
            $table->timestamps();
            // No pk es N-N
            /*
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                    */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
