<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome'); 
            $table->enum('periodo', ['Manhã', 'Tarde', 'Noite']);   
            $table->integer('anolectivo'); 
            $table->unsignedInteger('classe_id');
            $table->unsignedInteger('curso_id');                                
            $table->timestamps();
        });

        Schema::table('turmas', function($table){
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
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
        Schema::dropForeign(['classe_id']);        
        Schema::dropForeign(['curso_id']);        
        Schema::dropIfExists('turmas');
    }
}
