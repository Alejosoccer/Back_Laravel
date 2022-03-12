<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
// relacion con tabla montanas
            $table->unsignedBigInteger('mountains_id')->unsigned();
            $table->foreign('mountains_id')->references('id')->on('mountains'); 
//relacion con tabla partida
            $table->unsignedBigInteger('partidas_id')->unsigned();
            $table->foreign('partidas_id')->references('id')->on('partidas'); 
//relacion con usuario
            $table->unsignedBigInteger('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
//campos
            $table->string('numero');
            $table->string('n_personas');
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
        Schema::dropIfExists('reserva');
    }
}
