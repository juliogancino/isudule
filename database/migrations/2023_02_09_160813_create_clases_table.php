<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('descripcion')->nullable();
            $table->string('codigo')->nullable();
            $table->string('nom_materia')->nullable();
            $table->string('modalidad')->nullable();
            $table->unsignedBigInteger('horario_id');
            $table->unsignedBigInteger('horariof_id');
            $table->unsignedBigInteger('profesor_id');
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('carrera_id');
            $table->unsignedBigInteger('h_id');
            $table->unsignedBigInteger('periodo_id');
            $table->string('dia')->default('LUNES');
            $table->string('tipo')->default('Tutoria');
            $table->boolean('activo')->nullable()->default(true);
            $table->integer('user_id');
            $table->timestamps();            
            $table->foreign('horario_id')
                ->references('id')
                ->on('horarios'); 
            $table->foreign('horariof_id')
                ->references('id')
                ->on('horarios'); 
            $table->foreign('profesor_id')
                ->references('id')
                ->on('profesors'); 
            $table->foreign('materia_id')
                ->references('id')
                ->on('materias'); 
            $table->foreign('carrera_id')
                ->references('id')
                ->on('carreras'); 
            $table->foreign('h_id')
                ->references('id')
                ->on('horarios'); 
            $table->foreign('periodo_id')
                ->references('id')
                ->on('periodos'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clases');
    }
}
