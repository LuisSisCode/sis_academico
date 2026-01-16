<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docentes_carrera', function (Blueprint $table) {
            $table->id('ID_docente_carrera');
            $table->unsignedBigInteger('ID_carrera');
            $table->unsignedBigInteger('ID_docente');
            $table->dateTime('fecha_asignacion');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_docente')->references('ID_docente')->on('docentes')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docentes_carrera');
    }
};
