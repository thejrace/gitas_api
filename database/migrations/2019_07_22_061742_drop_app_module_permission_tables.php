<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAppModulePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('app_module_user_permissions');
        Schema::dropIfExists('app_module_permissions');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('app_module_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_module_id');
            $table->string('name');
            $table->tinyInteger('value_type');
            $table->string('default_value');

            $table->foreign('app_module_id')->on('app_modules')->references('id');
        });

        Schema::create('app_module_user_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('perm_id');
            $table->unsignedBigInteger('user_id');
            $table->string('value');

            $table->foreign('perm_id')->on('app_module_permissions')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
        });

    }
}
