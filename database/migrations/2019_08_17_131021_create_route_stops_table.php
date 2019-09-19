<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteStopsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('route_stops', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_id');
            $table->tinyInteger('direction');
            $table->tinyInteger('no');
            $table->string('name', 300);

            $table->foreign('route_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('route_stops');
    }
}
