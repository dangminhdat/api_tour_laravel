<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocationDetailTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("location_tour", function(Blueprint $table) {
            $table->increments("id");
            $table->integer('id_tour');
            $table->integer('id_location');
            $table->foreign('id_tour')->references('id')->on('tour')->onDelete('cascade');
            $table->foreign('id_location')->references('id')->on('location')->onDelete('cascade');
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
        Schema::dropIfExists("location_tour");
    }
}
