<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToImagenes extends Migration
{
    public function up()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
