<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Agrega ID_carrera si no existe
            if (!Schema::hasColumn('users', 'ID_carrera')) {
                $table->unsignedBigInteger('ID_carrera')->nullable()->after('ID_users');
            }

            // Verifica si existe la columna 'name' y cámbiala a 'nombre'
            if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'nombre')) {
                $table->renameColumn('name', 'nombre');
            }

            // Agrega tipo_usuario si no existe
            if (!Schema::hasColumn('users', 'tipo_usuario')) {
                $table->enum('tipo_usuario', ['Super usuario', 'Admin', 'Auxiliar'])
                      ->default('Auxiliar')
                      ->after('password');
            }

            // Agrega la foreign key
            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')
                  ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['ID_carrera']);

            // Revertir cambios
            if (Schema::hasColumn('users', 'nombre') && !Schema::hasColumn('users', 'name')) {
                $table->renameColumn('nombre', 'name');
            }

            $table->dropColumn(['ID_carrera', 'tipo_usuario']);
        });
    }
};
