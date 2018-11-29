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
            $table->date('date_depart');
            $table->integer('price_adults');
            $table->integer('price_childs');
            $table->string('time_depart');
            $table->text('address_depart');
            $table->integer('slot');
            $table->integer("booked");
            $table->tinyInteger('deleted_at')->default(0);
            $table->integer('id_guide');
            $table->integer('id_tour');
            $table->foreign('id_tour')->references('id')->on('tour')->onDelete('cascade');
            $table->foreign('id_guide')->references('id')->on('guide')->onDelete('cascade');
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
