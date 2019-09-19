<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteScannerUserConnections extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('route_scanner_user_connections', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_scanner_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('route_scanner_id')->references('id')->on('route_scanners');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('route_scanner_user_connections');
    }
}
