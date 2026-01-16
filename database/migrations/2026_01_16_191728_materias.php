<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id('ID_materia');
            $table->unsignedBigInteger('ID_carrera');
            $table->unsignedBigInteger('ID_semestre');
            $table->string('Nombre');
            $table->string('sigla');
            $table->integer('creditos');
            $table->text('descripcion')->nullable();
            $table->boolean('tiene_auxiliar')->default(false);
            $table->timestamps();

            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_semestre')->references('ID_semestre')->on('semestres')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
