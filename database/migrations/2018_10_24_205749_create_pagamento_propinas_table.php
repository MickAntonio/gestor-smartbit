<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentoPropinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_propinas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mes_id');                                
            $table->unsignedInteger('pagamento_id');                                
            $table->unsignedInteger('matricula_id');
            $table->timestamps();
        });

        Schema::table('pagamento_propinas', function($table){
            $table->foreign('mes_id')->references('id')->on('meses')->onDelete('cascade');
            $table->foreign('pagamento_id')->references('id')->on('pagamentos')->onDelete('cascade');
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
        Schema::dropForeign(['mes_id']);                                
        Schema::dropForeign(['pagamento_id']);                                
        Schema::dropForeign(['matricula_id']);
        Schema::dropIfExists('pagamento_propinas');
    }
}
