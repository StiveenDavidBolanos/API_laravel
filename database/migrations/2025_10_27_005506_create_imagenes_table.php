<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id('id_imagen');
            $table->foreignId('id_propiedad')->constrained('propiedades', 'id_propiedad')->onDelete('cascade');
            $table->string('url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
