<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAppModuleUsers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_module_users', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_module_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('api_token', 60);
            $table->foreign('app_module_id')->on('app_modules')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('app_module_users');
    }
}
