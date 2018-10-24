<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantidadeVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantidade_vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->unsignedInteger('estoque_id');
            $table->unsignedInteger('venda_id');
            $table->timestamps();

            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('venda_id')->references('id')->on('vendas');
            
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
        Schema::dropForeign('venda_id');
        Schema::dropIfExists('quantidade_vendas');
    }
}
