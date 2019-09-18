<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteScannersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('route_scanners', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->tinyInteger('status')->default(1)->nullable();
            $table->text('settings')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('route_scanners');
    }
}
