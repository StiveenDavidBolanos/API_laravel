<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id('id_ciudad');
            $table->string('nombre');
            $table->double('coordenada_x')->nullable();
            $table->double('coordenada_y')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ciudades');
    }
};
