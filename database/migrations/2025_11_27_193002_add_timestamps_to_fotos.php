<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToFotos extends Migration
{
    public function up()
    {
        Schema::table('fotos', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('fotos', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
