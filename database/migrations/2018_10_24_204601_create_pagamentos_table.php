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
            $table->unsignedInteger('pagamento_preco_id');                                
            $table->unsignedInteger('user_id');                                
            $table->timestamps();
        });

        Schema::table('pagamentos', function($table){
            $table->foreign('pagamento_preco_id')->references('id')->on('pagamento_precos')->onDelete('cascade');
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
        //Schema::dropForeign(['pagamento_preco_id']);                        
        //Schema::dropForeign(['user_id']);                        
        Schema::dropIfExists('pagamentos');
    }
}
