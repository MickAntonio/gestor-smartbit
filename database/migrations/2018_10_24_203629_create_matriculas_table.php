<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', ['Matricula', 'Confirmacao']);               
            $table->enum('condicao', ['Disciplina Atraso', 'Limpo','Repitente']);               
            $table->unsignedInteger('aluno_id');                                
            $table->unsignedInteger('turma_id');                                
            $table->timestamps();
        });

        Schema::table('matriculas', function($table){
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropForeign(['aluno_id']);                
        //Schema::dropForeign(['turma_id']);                
        Schema::dropIfExists('matriculas');
    }
}
