<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicosPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos_pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('servico_id');
            $table->unsignedInteger('pagamento_id');
            $table->timestamps();

            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->foreign('pagamento_id')->references('id')->on('pagamentos');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicos_pagamentos');
    }
}
