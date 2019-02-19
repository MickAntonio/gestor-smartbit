<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentoPropinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_propinas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total');    
            $table->decimal('valor_pago');    
            $table->text('descricao');    
            $table->enum('forma', ['TPA', 'Dinheiro', 'Banco']);               
            $table->unsignedInteger('matricula_id');
            $table->unsignedInteger('user_id');                                                
            $table->timestamps();
        });

        Schema::table('pagamento_propinas', function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        //Schema::dropForeign(['user_id']);                        
        //Schema::dropForeign(['matricula_id']);
        Schema::dropIfExists('pagamento_propinas');
    }
}
