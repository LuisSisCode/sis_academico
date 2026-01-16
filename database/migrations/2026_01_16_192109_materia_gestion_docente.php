<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materia_gestion_docente', function (Blueprint $table) {
            $table->id('ID_materia_gestion_docente');
            $table->unsignedBigInteger('ID_docente');
            $table->unsignedBigInteger('ID_materia');
            $table->unsignedBigInteger('ID_gestion');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('ID_docente')->references('ID_docente')->on('docentes')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_materia')->references('ID_materia')->on('materias')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_gestion')->references('ID_gestion')->on('gestiones')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materia_gestion_docente');
    }
};
