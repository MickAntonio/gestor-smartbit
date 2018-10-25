<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscolaAnteriorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escola_anterior', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');             
            $table->string('classe');             
            $table->string('periodo');             
            $table->string('anolectivo');                       
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
        Schema::dropIfExists('escola_anterior');
    }
}
