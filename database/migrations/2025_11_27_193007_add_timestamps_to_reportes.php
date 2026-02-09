<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToReportes extends Migration
{
    public function up()
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
