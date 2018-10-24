<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantidadeProdutosDanificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantidade_produtos_danificados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->unsignedInteger('estoque_id');
            $table->unsignedInteger('produto_danificado_id');
            $table->timestamps();

            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('produto_danificado_id')->references('id')->on('produtos_danificados');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('estoque_id');
        Schema::dropForeign('produto_danificado_id');
        Schema::dropIfExists('quantidade_produtos_danificados');
    }
}
