<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('propiedades', function (Blueprint $table) {
            // 1. Renombrar la columna 'tipo' o 'id_tipo' a 'idtipo' de forma segura
            if (!Schema::hasColumn('propiedades', 'idtipo')) {
                if (Schema::hasColumn('propiedades', 'tipo')) {
                    $table->renameColumn('tipo', 'idtipo');
                } elseif (Schema::hasColumn('propiedades', 'id_tipo')) {
                    $table->renameColumn('id_tipo', 'idtipo');
                }
            }
        });

        Schema::table('propiedades', function (Blueprint $table) {
            // 2. Cambiar el tipo de dato y agregar la llave foránea
            if (Schema::hasColumn('propiedades', 'idtipo')) {
                $table->unsignedBigInteger('idtipo')->change();
                $table->foreign('idtipo')->references('idTipo')->on('tipos');
            }
        });
    }

    public function down(): void
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->dropForeign(['idtipo']);
            if (Schema::hasColumn('propiedades', 'idtipo')) {
                $table->renameColumn('idtipo', 'tipo');
            }
        });

        Schema::table('propiedades', function (Blueprint $table) {
            if (Schema::hasColumn('propiedades', 'tipo')) {
                $table->string('tipo')->change();
            }
        });
    }
};
