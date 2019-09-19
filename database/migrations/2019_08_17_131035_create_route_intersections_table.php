<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteIntersectionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('route_intersections', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('active_route_id');
            $table->unsignedBigInteger('intersected_route_id');
            $table->tinyInteger('direction');
            $table->string('stop_name', 300);
            $table->bigInteger('total_diff');

            $table->foreign('active_route_id')->references('id')->on('routes');
            $table->foreign('intersected_route_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('route_intersections');
    }
}
