<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auxiliares', function (Blueprint $table) {
            $table->id('ID_auxiliar');
            $table->unsignedBigInteger('ID_materia');
            $table->unsignedBigInteger('ID_carrera');
            $table->unsignedBigInteger('ID_users');
            $table->string('celular')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('ID_materia')->references('ID_materia')->on('materias')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('ID_users')->references('ID_users')->on('users')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auxiliares');
    }
};
