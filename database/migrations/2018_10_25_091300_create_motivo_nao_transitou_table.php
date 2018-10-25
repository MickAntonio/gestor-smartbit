<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivoNaoTransitouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_nao_transitou', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('motivo', ['EEF', 'Anulacao', 'Outro']);                                       
            $table->unsignedInteger('matricula_id');
            $table->timestamps();
        });

        Schema::table('motivo_nao_transitou', function($table){
            $table->foreign('matricula_id')->references('id')->on('matriculas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(['matricula_id']);
        Schema::dropIfExists('motivo_nao_transitou');
    }
}
