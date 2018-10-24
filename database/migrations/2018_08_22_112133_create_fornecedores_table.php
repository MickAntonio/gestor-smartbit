<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->unsignedInteger('endereco_id');
            $table->unsignedInteger('contacto_id');
            $table->timestamps();

            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->foreign('contacto_id')->references('id')->on('contactos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('endereco_id');
        Schema::dropForeign('contacto_id');
        Schema::dropIfExists('fornecedores');
    }
}
