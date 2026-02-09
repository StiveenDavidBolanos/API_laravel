<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->unsignedBigInteger('id_reportante');
            $table->unsignedBigInteger('id_reportado');
            $table->unsignedBigInteger('id_propiedad')->nullable();
            $table->unsignedBigInteger('id_motivo')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('evidencia_url')->nullable();
            $table->boolean('activo')->default('true');
            $table->timestamp('fecha')->useCurrent();

            $table->foreign('id_reportante')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_reportado')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_propiedad')->references('id_propiedad')->on('propiedades')->onDelete('set null');
            $table->foreign('id_motivo')->references('id_motivo')->on('motivos')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
