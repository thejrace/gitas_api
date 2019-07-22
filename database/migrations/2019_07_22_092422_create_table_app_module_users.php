<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAppModuleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_module_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_module_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('app_module_token', 60);
            $table->foreign('app_module_id')->on('app_modules')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_module_users');
    }
}
