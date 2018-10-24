<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoVariacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_variacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('estoque_id');
            $table->unsignedInteger('atributo_id');
            $table->timestamps();

            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('atributo_id')->references('id')->on('atributos');
            
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIndex('estoque_id');
        Schema::dropForeign('atributo_id');
        Schema::dropIfExists('produto_variacoes');
    }
}
