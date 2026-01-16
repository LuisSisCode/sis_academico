<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupo_whatsapp', function (Blueprint $table) {
            $table->id('ID_grupo');
            $table->unsignedBigInteger('ID_gestion');
            $table->unsignedBigInteger('ID_materia');
            $table->string('link');
            $table->timestamps();

            $table->foreign('ID_gestion')->references('ID_gestion')->on('gestiones')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_materia')->references('ID_materia')->on('materias')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupo_whatsapp');
    }
};
