<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('bi')->nullable();
            $table->enum('genero', ['M', 'F']);
            $table->string('data_nascimento')->nullable();
            $table->unsignedInteger('contacto_id');
            $table->timestamps();

            $table->foreign('contacto_id')->references('id')->on('contactos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('contacto_id');
        Schema::dropIfExists('clientes');
    }
}
