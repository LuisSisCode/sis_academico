<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_academico', function (Blueprint $table) {
            $table->id('ID_material');
            $table->unsignedBigInteger('ID_materia_gestion_docente');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('tipo_material', ['Contenidos', 'Practicos', 'Proyectos', 'Examenes']);
            $table->string('archivo_nombre')->nullable();
            $table->string('archivo_ruta')->nullable();
            $table->string('archivo_tipo')->nullable();
            $table->bigInteger('archivo_tamanio')->nullable();
            $table->timestamps();

            $table->foreign('ID_materia_gestion_docente')->references('ID_materia_gestion_docente')
                ->on('materia_gestion_docente')->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_academico');
    }
};
