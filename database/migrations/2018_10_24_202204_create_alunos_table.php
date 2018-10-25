<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('processo');    
            $table->unsignedInteger('candidato_id');                    
            $table->unsignedInteger('curso_id');                    
            $table->timestamps();
        });

        Schema::table('alunos', function($table){
            $table->foreign('candidato_id')->references('id')->on('candidatos')->onDelete('cascade');
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
        Schema::dropForeign(['candidato_id']);                
        Schema::dropForeign(['cursos_id']);                
        Schema::dropIfExists('alunos');
    }
}
