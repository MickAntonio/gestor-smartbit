<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantidadeMovimentacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantidade_movimentacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->unsignedInteger('produto_id');                        
            $table->unsignedInteger('estoque_id');
            $table->unsignedInteger('movimentacao_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');            
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('movimentacao_id')->references('id')->on('movimentacoes');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('produto_id');        
        Schema::dropForeign('estoque_id');
        Schema::dropForeign('movimentacao_id');
        Schema::dropIfExists('quantidade_movimentacoes');
    }
}
