<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');    
            $table->enum('tipo', ['Entrada', 'Saida']);               
            $table->enum('proveniencia', ['Aluno', 'Outro']);               
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
        Schema::dropIfExists('tipo_pagamentos');
    }
}
