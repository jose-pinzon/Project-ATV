<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_reservas', function (Blueprint $table) {
            $table->increments('id_detalle_reserva');
            $table->dateTime('fecha_hora');
            $table->integer('sencillo');
            $table->float('precio_sencillo');
            $table->integer('doble');
            $table->float('precio_doble');
            $table->float('total');
            $table->integer('descuento');
             //relacion con reservas
             $table->integer('id_reserva')->unsigned();
             //relacion
             $table->foreign('id_reserva')->references('id_reserva')->on('reservas');
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
        Schema::dropIfExists('detalle_reservas');
    }
}
