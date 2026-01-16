<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_auxiliar', function (Blueprint $table) {
            $table->id('ID_material_auxiliar');
            $table->unsignedBigInteger('ID_auxiliar');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('archivo_nombre')->nullable();
            $table->string('archivo_ruta')->nullable();
            $table->string('archivo_tipo')->nullable();
            $table->bigInteger('archivo_tamanio')->nullable();
            $table->text('enlaces')->nullable();
            $table->timestamps();

            $table->foreign('ID_auxiliar')->references('ID_auxiliar')->on('auxiliares')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_auxiliar');
    }
};
