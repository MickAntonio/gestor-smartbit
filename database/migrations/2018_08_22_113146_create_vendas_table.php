<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total');
            $table->decimal('desconto')->nullable();
            $table->decimal('pagamento');
            $table->enum('forma_pagamento', ['Dinheiro', 'Cheque', 'Cartao']);
            $table->enum('estado', ['Concluido', 'Cancelado']);
            $table->unsignedInteger('produto_id');
            $table->unsignedInteger('usuario_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('produto_id');
        Schema::dropForeign('usuario_id');
        Schema::dropIfExists('vendas');
    }
}
