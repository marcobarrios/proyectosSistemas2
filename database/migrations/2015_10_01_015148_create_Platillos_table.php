<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatillosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Platillos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('temporada_id')->unsigned();
		    $table->foreign('temporada_id')->references('id')->on('Temporada');
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->string('descripcion');
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
        Schema::drop('Platillos');
    }
}
