<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id('id_calificacion');
            $table->double('calificacion')->check('calificacion >= 0 AND calificacion <= 5');
            $table->foreignId('id_usuario_calificador')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_usuario_calificado')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->text('resena')->nullable();
            $table->timestamp('fecha')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
