<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropinasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propinas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('multa');    
            $table->unsignedInteger('mes_id');                                
            $table->unsignedInteger('pagamento_propina_id');                                
            $table->unsignedInteger('preco_classe_id');
            $table->timestamps();
        });

        Schema::table('propinas', function($table){
            $table->foreign('mes_id')->references('id')->on('meses')->onDelete('cascade');
            $table->foreign('pagamento_propina_id')->references('id')->on('pagamento_propinas')->onDelete('cascade');
            $table->foreign('preco_classe_id')->references('id')->on('preco_classes')->onDelete('cascade');
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
        Schema::dropForeign(['pagamento_propina_id']);                                
        Schema::dropForeign(['preco_classe_id']);
        Schema::dropIfExists('propinas');
    }
}
