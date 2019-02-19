<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecoClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preco_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado', ['Activado', 'Desactivo']);                           
            $table->unsignedInteger('classe_id');           
            $table->unsignedInteger('preco_id'); 
            $table->unsignedInteger('curso_id');                    
            $table->timestamps();
        });

        Schema::table('preco_classes', function($table){
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('preco_id')->references('id')->on('precos')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropForeign(['classe_id']);                                
        //Schema::dropForeign(['preco_id']);         
        //Schema::dropForeign(['curso_id']); 
        Schema::dropIfExists('preco_classes');
    }
}
