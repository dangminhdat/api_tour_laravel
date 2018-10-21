<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("tour", function(Blueprint $table) {
            $table->increments("id");
            $table->string('name');
            $table->integer('number_days');
            $table->dateTime('date_created');
            $table->string("item_tour");
            $table->integer("discount");
            $table->text('images');
            $table->text('programs');
            $table->text('note');
            $table->tinyInteger('deleted_at')->default(0);
            $table->integer('id_type_tour');
            $table->foreign('id_type_tour')->references('id')->on('type_tour')->onDelete('restrict');
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
        Schema::dropIfExists("tour");
    }
}
