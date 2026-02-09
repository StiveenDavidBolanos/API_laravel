<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id('id_propiedad');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('id_tipo')->nullable();
            $table->double('precio')->nullable();
            $table->double('coordenada_x')->nullable();
            $table->double('coordenada_y')->nullable();
            $table->foreignId('id_ciudad')->nullable()->constrained('ciudades', 'id_ciudad')->onDelete('set null');
            $table->foreignId('id_usuario')->nullable()->constrained('usuarios', 'id_usuario')->onDelete('set null');
            $table->integer('banos')->nullable();
            $table->integer('dormitorios')->nullable();
            $table->boolean('bano_compartido')->default(false);
            $table->boolean('amoblado')->default(false);
            $table->boolean('dueno_residente')->default(false);
            $table->boolean('servicios_incluidos')->default(false);
            $table->boolean('cocina_separada')->default(false);
            $table->boolean('horario_limitado')->default(false);
            $table->boolean('aire_acondicionado')->default(false);
            $table->boolean('permite_mascotas')->default(false);
            $table->boolean('corriente_220')->default(false);
            $table->boolean('disponible')->default(true);
            $table->boolean('verificado')->default(false);
            $table->boolean('destacado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
};
