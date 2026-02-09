<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToFavoritos extends Migration
{
    public function up()
    {
        Schema::table('favoritos', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('favoritos', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
