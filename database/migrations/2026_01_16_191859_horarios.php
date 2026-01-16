<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('ID_horario');
            $table->unsignedBigInteger('ID_gestion');
            $table->unsignedBigInteger('ID_carrera');
            $table->enum('archivo_tipo', ['pdf', 'imagen', 'excel', 'word', 'texto']);
            $table->string('archivo_nombre');
            $table->string('archivo_ruta');
            $table->timestamps();

            $table->foreign('ID_gestion')->references('ID_gestion')->on('gestiones')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
