<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id_reserva');
            $table->date('fecha_reserva');
            $table->string('comentario')->nullable();
            $table->enum('estado',['PENDIENTE','REALIZADO']);
             //relacion con horario
             $table->integer('id_horario')->unsigned();
             //relacion
             $table->foreign('id_horario')->references('id_horario')->on('horarios');
             //relacion con cliente
             $table->integer('id_cliente')->unsigned();
             //relacion
             $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
             //relacion con guia
             $table->integer('id_guia')->unsigned();
             //relacion
             $table->foreign('id_guia')->references('id_guia')->on('guias');

             //slug
             $table->string('slug')->unique();

            $table->timestamps();

            //pendiente relacion con el usuario
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
