<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Eliminar columnas antiguas
            $table->dropColumn('procedencia');
            $table->dropColumn('residencia');

            // Agregar llaves foráneas a ciudades
            $table->unsignedBigInteger('id_procedencia')->nullable()->after('foto');
            $table->unsignedBigInteger('id_residencia')->nullable()->after('id_procedencia');

            $table->foreign('id_procedencia')->references('id_ciudad')->on('ciudades')->nullOnDelete();
            $table->foreign('id_residencia')->references('id_ciudad')->on('ciudades')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Quitar las llaves foráneas nuevas
            $table->dropForeign(['id_procedencia']);
            $table->dropForeign(['id_residencia']);

            $table->dropColumn('id_procedencia');
            $table->dropColumn('id_residencia');

            // Restaurar columnas antiguas
            $table->string('procedencia')->nullable();
            $table->string('residencia')->nullable();
        });
    }
};
