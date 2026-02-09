<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToCalificaciones extends Migration
{
    public function up()
    {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
