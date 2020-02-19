<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('nombre')->nullable();
            $table->string('ruta')->nullable();
            $table->string('tipo')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('idsolicitud');
            $table->timestamps();

           // $table->foreign('idsolicitud')
             //       ->references('id')->on('solicituds'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
