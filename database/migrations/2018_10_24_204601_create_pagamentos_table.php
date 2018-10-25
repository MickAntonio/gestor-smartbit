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
            $table->decimal('valor_pago');    
            $table->text('descricao');    
            $table->enum('forma', ['TPA', 'Dinheiro', 'Banco']);               
            $table->unsignedInteger('tipo_pagamento_id');                                
            $table->unsignedInteger('user_id');                                
            $table->timestamps();
        });

        Schema::table('pagamentos', function($table){
            $table->foreign('tipo_pagamento_id')->references('id')->on('tipo_pagamentos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropForeign(['user_id']);                        
        Schema::dropIfExists('pagamentos');
    }
}
