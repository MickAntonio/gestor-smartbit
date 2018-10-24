<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao')->nullable();
            $table->enum('estado', ['Espera', 'Compareceu', 'Nao  Compareceu', 'Cancelado']);
            $table->string('data_marcada')->nullable();
            $table->unsignedInteger('cliente_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('cliente_id');
        Schema::dropIfExists('marcacoes');
    }
}
