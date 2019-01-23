<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pagamento_id');                                
            $table->unsignedInteger('matricula_id');
            $table->timestamps();
        });

        Schema::table('aluno_pagamentos', function($table){
            $table->foreign('pagamento_id')->references('id')->on('pagamentos')->onDelete('cascade');
            $table->foreign('matricula_id')->references('id')->on('matriculas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropForeign(['pagamento_id']);                                
        //Schema::dropForeign(['matricula_id']);
        Schema::dropIfExists('aluno_pagamentos');
    }
}
