<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFtsVersionControlTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fts_versions', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('major');
            $table->unsignedInteger('minor');
            $table->unsignedInteger('patch');
            $table->string('change_log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('fts_versions');
    }
}
