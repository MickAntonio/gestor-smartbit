<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosPrecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos_precos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado', ['Activado', 'Desactivo']);                           
            $table->unsignedInteger('tipo_pagamento_id');                    
            $table->unsignedInteger('preco_id');
            $table->timestamps();
        });

        Schema::table('pagamentos_precos', function($table){
            $table->foreign('tipo_pagamento_id')->references('id')->on('tipo_pagamentos')->onDelete('cascade');
            $table->foreign('preco_id')->references('id')->on('precos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(['tipo_pagamento_id']);                                
        Schema::dropForeign(['preco_id']);   
        Schema::dropIfExists('pagamentos_precos');
    }
}
