<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinaAtrasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplina_atrasos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('disciplina');                
            $table->unsignedInteger('matricula_id');
            $table->unsignedInteger('classe_id');
            $table->timestamps();
        });

        Schema::table('disciplina_atrasos', function($table){
            $table->foreign('matricula_id')->references('id')->on('matriculas')->onDelete('cascade');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
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
        Schema::dropForeign(['matricula_id']);
        Schema::dropIfExists('disciplina_atrasos');
    }
}
