<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetalleCompras', function(Blueprint $table) {
            $table->increments('id');
            
		$table->integer('materia_prima_id')->unsigned();
		  $table->foreign('materia_prima_id')->references('id')->on('MateriaPrima');
		  $table->integer('compras_id')->unsigned();
		  $table->foreign('compras_id')->references('id')->on('Compras');
          $table->integer('cantidad');
		  $table->decimal('costo', 10, 2);
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
        Schema::drop('DetalleCompras');
    }
}
