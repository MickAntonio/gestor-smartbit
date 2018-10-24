<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosDanificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_danificados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao')->nullable();
            $table->enum('considerar_estoque', ['Nao', 'Sim']);
            $table->unsignedInteger('produto_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
            
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
        Schema::dropIfExists('produtos_danificados');
    }
}
