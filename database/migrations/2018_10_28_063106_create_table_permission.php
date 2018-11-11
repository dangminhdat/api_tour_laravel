<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("permission", function(Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_create')->default(0);
            $table->tinyInteger('is_view')->default(0);
            $table->tinyInteger('is_update')->default(0);
            $table->tinyInteger('is_delete')->default(0);
            $table->integer('id_group');
            $table->integer('id_resource');
            $table->foreign('id_group')->references('id')->on('groups')->onDelete('restrict');
            $table->foreign('id_resource')->references('id')->on('resource')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('permission');
    }
}
