<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type');
            $table->string('name', 300);
            $table->tinyInteger('status');
            $table->text('settings')->nullable();
            $table->string('api_token', 60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
