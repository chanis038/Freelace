<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
             
            $table->bigIncrements('id');
            $table->enum('tipo',["PM","PD","PB","PV","PBV"])->nullable();
            $table->string('estado')->nullable();
            $table->text('justificacion')->nullable();
            $table->decimal('monto',10,2)->nullable();
            $table->string('monto_letras')->nullable();
            $table->date('fecha_viaje')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('registroUser');
            $table->boolean('visto');
            $table->boolean('visto_user');
            $table->text('observacion')->nullable();
            $table->timestamps();
            
            //$table->foreign('registroUser')
              //      ->references('registro')->on('users'); 
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituds');
    }
}
