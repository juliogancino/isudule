<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesors', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('nombre')->nullable();            
            $table->string('apellido')->nullable();            
            $table->string('descripcion')->nullable();
            $table->string('codigo')->nullable();
            $table->string('imagen')->nullable();
            $table->string('tiempo')->nullable();
            $table->integer('hdocencia')->nullable()->default(40);
            $table->integer('hinvestiga')->nullable()->default(0);
            $table->integer('hvincula')->nullable()->default(0);
            $table->integer('hgestion')->nullable()->default(0);
            $table->boolean('activo')->nullable()->default(true);  

            $table->unsignedBigInteger('carrera_id');

            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('profesors');
    }
}
