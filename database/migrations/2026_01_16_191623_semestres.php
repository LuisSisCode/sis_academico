<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semestres', function (Blueprint $table) {
            $table->id('ID_semestre');
            $table->unsignedBigInteger('ID_carrera');
            $table->string('nombre');
            $table->integer('numero_semestre');
            $table->enum('tipo', ['Regular', 'Verano'])->default('Regular');
            $table->timestamps();

            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semestres');
    }
};
