<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersonOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("person_order", function(Blueprint $table) {
            $table->increments("id");
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('note');
            $table->integer('num_adults');
            $table->integer('num_childs');
            $table->date('date_ordered');
            $table->tinyInteger('deleted_at')->default(0);
            // $table->integer('id_formality');
            $table->integer('id_detail_tour');
            $table->integer('id_user');
            // $table->foreign('id_formality')->references('id')->on('formality')->onDelete('restrict');
            $table->foreign('id_detail_tour')->references('id')->on('detail_tour')->onDelete('restrict');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("person_order");
    }
}
