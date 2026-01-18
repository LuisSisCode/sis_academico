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
        Schema::table('horarios', function (Blueprint $table) {
            // 1. Agregar la columna ID_semestre
            $table->unsignedBigInteger('ID_semestre')->nullable()->after('ID_horario'); // Cambia 'ID_horario' por la columna después de la cual quieres que aparezca

            // 2. Crear la relación de clave foránea
            $table->foreign('ID_semestre')
                  ->references('ID_semestre')
                  ->on('semestres')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            // 3. Opcional: Para relación 1:1, puedes agregar un índice único
            // $table->unique('ID_semestre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horarios', function (Blueprint $table) {
            // 1. Eliminar la clave foránea
            $table->dropForeign(['ID_semestre']);

            // 2. Eliminar la columna
            $table->dropColumn('ID_semestre');
        });
    }
};
