<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('desconto')->nullable();
            $table->decimal('pagamento');
            $table->enum('forma_pagamento', ['Dinheiro', 'Cheque', 'Cartao']);
            $table->string('descricao')->nullable();
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('usuario_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
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
        Schema::dropForeign('cliente_id');
        Schema::dropForeign('usuario_id');
        Schema::dropIfExists('pagamentos');
    }
}
