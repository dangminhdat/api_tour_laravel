<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("review", function(Blueprint $table) {
            $table->increments("id");
            $table->string('score');
            $table->string('content');
            $table->dateTime('date_review');
            $table->tinyInteger('deleted_at')->default(0);
            $table->integer('id_tour');
            $table->integer('id_user');
            $table->foreign('id_tour')->references('id')->on('tour')->onDelete('restrict');
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
        Schema::dropIfExists('review');
    }
}
