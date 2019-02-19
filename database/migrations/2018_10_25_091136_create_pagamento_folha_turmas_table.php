<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentoFolhaTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_folha_turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade_folhas');   
            $table->unsignedInteger('turma_id');                                             
            $table->unsignedInteger('pagamento_id');                                
            $table->timestamps();
        });

        Schema::table('pagamento_folha_turmas', function($table){
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->foreign('pagamento_id')->references('id')->on('pagamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropForeign(['turma_id']);                                        
        //Schema::dropForeign(['pagamento_id']);                                        
        Schema::dropIfExists('pagamento_folha_turmas');
    }
}
