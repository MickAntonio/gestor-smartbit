<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('preco')->nullable();
            $table->decimal('pagamento')->nullable();
            $table->enum('forma_pagamento', ['Dinheiro', 'Cheque', 'Cartao']);
            $table->unsignedInteger('fornecedor_id');

            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
            
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
        Schema::dropForeign('fornecedor_id');
        Schema::dropIfExists('compras');
    }
}
