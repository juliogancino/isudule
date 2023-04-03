<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('nombre')->nullable();            
            $table->string('descripcion')->nullable();
            $table->string('codigo')->nullable();
            $table->string('carrera_nomb')->nullable();
            $table->unsignedBigInteger('carrera_id');
            $table->boolean('activo')->nullable()->default(true);
            $table->integer('color')->default(1);              

            $table->timestamps();
            
            $table->foreign('carrera_id')
                ->references('id')
                ->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
