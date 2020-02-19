<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           
            
          // $table->bigIncrements('id');
            $table->string('p_nombre')->nullable();
            $table->string('s_nombre')->nullable();
            $table->string('p_apellido')->nullable();
            $table->string('s_apellido')->nullable();
            $table->integer('edad')->nullable();
            $table->string('estdo_civil')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('profesion')->nullable();
            $table->string('direccion')->nullable();
            $table->bigInteger('nit')->nullable();
            $table->string('correo')->nullable();
            $table->bigInteger('dpi')->nullable()->unique();
            $table->string('municipio')->nullable();
            $table->bigInteger('n_telefono')->nullable();
            $table->bigInteger('n_celular')->nullable();

            //datos Docencia
            $table->integer('registro')->unique();
            $table->string('unidad_academica')->nullable();
            $table->bigInteger('n_carne')->nullable()->unique();
            $table->string('departamento')->nullable();
            $table->string('cargo')->nullable();
            $table->string('titularidad')->nullable();
            $table->string('catedras')->nullable();


            $table->string('slug')->nullable()->unique();
            $table->string('password')->nullable();
            $table->enum('perfil',['D','K','R','T','U'])->nullable();
            $table->timestamps();

            $table->primary('registro');
            //$table->rememberToken();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
