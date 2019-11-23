<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('buses', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('active_plate');
            $table->string('official_plate');
            $table->string('code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
