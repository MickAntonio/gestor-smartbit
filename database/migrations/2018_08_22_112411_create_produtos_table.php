<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('codigo')->nullable();
            $table->string('modelo')->nullable();
            $table->string('dimensoes')->nullable();
            $table->string('peso')->nullable();
            $table->string('imagem')->nullable();
            $table->decimal('valor_compra')->nullable();
            $table->decimal('despesas')->nullable();
            $table->decimal('valor_venda')->nullable();
            $table->enum('variacao', ['Sim', 'Nao']);
            $table->enum('comercial', ['Sim', 'Nao']);
            $table->text('descricao')->nullable();
            $table->unsignedInteger('subcategoria_id');
            $table->unsignedInteger('fornecedor_id');

            $table->foreign('subcategoria_id')->references('id')->on('subcategorias');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('subcategoria_id');
        Schema::dropForeign('fornecedor_id');
        Schema::dropIfExists('produtos');
    }
}
