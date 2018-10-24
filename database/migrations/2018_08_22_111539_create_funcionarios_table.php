<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('bi')->nullable();
            $table->enum('genero', ['M', 'F']);
            $table->string('data_nascimento')->nullable();
            $table->string('foto')->nullable();
            $table->string('cargo')->nullable();
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
        Schema::dropIfExists('funcionarios');
    }
}
