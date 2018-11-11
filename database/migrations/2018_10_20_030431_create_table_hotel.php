<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHotel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("hotel", function(Blueprint $table) {
            $table->increments("id");
            $table->string('name');
            $table->integer('price_room');
            $table->string('address');
            $table->string('phone');
            $table->string('website');
            $table->tinyInteger('deleted_at')->default(0);
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
        Schema::dropIfExists("hotel");
    }
}
