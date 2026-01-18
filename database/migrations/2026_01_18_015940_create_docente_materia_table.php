<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('docente_materia', function (Blueprint $table) {
            $table->id('ID_docente_materia');
            $table->unsignedBigInteger('ID_docente');
            $table->unsignedBigInteger('ID_materia');
            $table->timestamps();

            // Foreign keys
            $table->foreign('ID_docente')
                ->references('ID_docente')
                ->on('docentes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('ID_materia')
                ->references('ID_materia')
                ->on('materias')
                ->onDelete('no action')
                ->onUpdate('no action');

            // Índice único para evitar duplicados
            $table->unique(['ID_docente', 'ID_materia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docente_materia');
    }
};
