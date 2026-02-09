<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            //
            Schema::table('usuarios', function (Blueprint $table) {
                if (Schema::hasColumn('usuarios', 'created')) {
                    $table->renameColumn('created', 'created_at');
                }
                if (Schema::hasColumn('usuarios', 'updated')) {
                    $table->renameColumn('updated', 'updated_at');
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            if (Schema::hasColumn('usuarios', 'created_at')) {
                $table->renameColumn('created_at', 'created');
            }
            if (Schema::hasColumn('usuarios', 'updated_at')) {
                $table->renameColumn('updated_at', 'updated');
            }
        });
    }
};
