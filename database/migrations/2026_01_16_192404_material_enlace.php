<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_enlaces', function (Blueprint $table) {
            $table->id('ID_material_enlaces');
            $table->unsignedBigInteger('ID_material_auxiliar');
            $table->string('url');
            $table->text('Descripcion')->nullable();
            $table->integer('orden')->default(0);
            $table->timestamps();

            $table->foreign('ID_material_auxiliar')->references('ID_material_auxiliar')
                ->on('material_auxiliar')->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_enlaces');
    }
};
