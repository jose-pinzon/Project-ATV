<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->increments('id_ingreso');
            $table->dateTime('fecha_hora');
            $table->string('descripcion',150)->nullable();
            $table->integer('cantidad');
            $table->string('forma_pago',90);
            $table->string('mov_banco')->nullable();
            $table->float('pago_unitario');
            $table->float('total');
            //relacion con detalle_reservas
            $table->integer('id_detalle_reserva')->unsigned();
            //relacion
            $table->foreign('id_detalle_reserva')->references('id_detalle_reserva')->on('detalle_reservas');
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
        Schema::dropIfExists('ingresos');
    }
}
