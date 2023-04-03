<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('nombre')->nullable(); 
            $table->string('descripcion')->nullable();
            $table->string('codigo')->nullable();
            $table->date('fec_ini')->nullable();
            $table->date('fec_fin')->nullable();
            $table->string('modalidad');
            $table->integer('nivel');
            $table->boolean('activo')->nullable()->default(true);
            $table->integer('user_id');
            $table->unsignedBigInteger('carrera_id');
            $table->unsignedBigInteger('periodo_id');
            $table->timestamps();
            $table->foreign('carrera_id')
                ->references('id')
                ->on('carreras');
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
        Schema::dropIfExists('horarios');
    }
}
