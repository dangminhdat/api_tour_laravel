<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHotelDetailTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("hotel_tour", function(Blueprint $table) {
            $table->increments("id");
            $table->integer('id_detail_tour');
            $table->integer('id_hotel');
            $table->foreign('id_detail_tour')->references('id')->on('detail_tour')->onDelete('restrict');
            $table->foreign('id_hotel')->references('id')->on('hotel')->onDelete('restrict');
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
        Schema::dropIfExists("hotel_tour");
    }
}
