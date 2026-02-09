<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono', 50)->nullable();
            $table->string('contrasena');
            $table->string('foto')->nullable();
            $table->string('residencia')->nullable();
            $table->string('procedencia')->nullable();
            $table->timestamp('fecha_nacimiento')->nullable();
            $table->timestamp('created')->useCurrent();
            $table->timestamp('updated')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
