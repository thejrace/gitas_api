<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeBusCodeNullable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('buses', function(Blueprint $table) {
            $table->string('code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('buses', function(Blueprint $table) {
            $table->string('code')->nullable(false)->change();
        });
    }
}
