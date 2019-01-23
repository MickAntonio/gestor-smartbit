<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');             
            $table->string('nascido');             
            $table->string('sexo');             
            $table->string('bi');             
            $table->string('naturalidade');     
            $table->string('bairro');             
            $table->string('pai');             
            $table->string('mae');             
            $table->string('email');             
            $table->string('telefone');             
            $table->string('telefone_pai');             
            $table->string('telefone_mae');             
            $table->unsignedInteger('municipio_id');                    
            $table->unsignedInteger('escola_anterior_id');                    
           
            $table->timestamps();
        });

        Schema::table('candidatos', function($table){
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('cascade');
            $table->foreign('escola_anterior_id')->references('id')->on('escola_anteriors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropForeign(['municipio_id']);        
        //Schema::dropForeign(['escola_anterior_id']);        
        Schema::dropIfExists('candidatos');
    }
}
