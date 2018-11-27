<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTraveler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("traveler", function(Blueprint $table) {
            $table->increments("id");
            $table->string('name');
            $table->tinyInteger('gender');
            $table->dateTime('birth');
            $table->tinyInteger('cat_traveler');
            $table->tinyInteger('check_room');
            $table->tinyInteger('deleted_at')->default(0);
            $table->integer('id_person_order');
            $table->foreign('id_person_order')->references('id')->on('person_order')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("traveler");
    }
}
