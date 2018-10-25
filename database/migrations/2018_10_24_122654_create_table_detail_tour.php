<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("detail_tour", function(Blueprint $table) {
            $table->increments("id");
            $table->dateTime('date_depart');
            $table->integer('price_adults');
            $table->integer('price_childs');
            $table->string('time_depart');
            $table->text('address_depart');
            $table->integer('slot');
            $table->tinyInteger('deleted_at')->default(0);
            $table->integer('id_image');
            $table->integer('id_guide');
            $table->integer('id_hotel');
            $table->integer('id_tour');
            $table->integer('id_type_tour');
            $table->foreign('id_type_tour')->references('id')->on('type_tour')->onDelete('restrict');
            $table->foreign('id_tour')->references('id')->on('tour')->onDelete('restrict');
            $table->foreign('id_guide')->references('id')->on('guide')->onDelete('restrict');
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
        Schema::dropIfExists("detail_tour");
    }
}
