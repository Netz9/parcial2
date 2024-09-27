<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); 
            $table->string('apellido', 100); 
            $table->string('email')->unique(); 
            $table->string('telefono', 15);
            $table->string('direccion', 150);
            $table->date('fecha_nacimiento');
            $table->string('carrera', 100); 
            $table->integer('semestre');
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
        Schema::dropIfExists('estudiantes');
    }
}
