<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos', function (Blueprint $table) {
            // Definimos idTipo como Primary Key autoincremental
            $table->id('idTipo');

            $table->string('tipo'); // Requerido por defecto
            $table->text('descripcion')->nullable(); // Nullable

            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos');
    }
};
