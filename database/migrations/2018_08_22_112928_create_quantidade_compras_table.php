<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantidadeComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantidade_compras', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('quantidade');
            $table->unsignedInteger('produto_id');            
            $table->unsignedInteger('estoque_id');
            $table->unsignedInteger('compra_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('compra_id')->references('id')->on('compras');
            
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
        Schema::dropForeign('compra_id');
        Schema::dropIfExists('quantidade_compras');
    }
}
