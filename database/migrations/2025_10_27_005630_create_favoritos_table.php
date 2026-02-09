<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id('id_favorito');
            $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_propiedad')->constrained('propiedades', 'id_propiedad')->onDelete('cascade');
            $table->timestamp('fecha')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
