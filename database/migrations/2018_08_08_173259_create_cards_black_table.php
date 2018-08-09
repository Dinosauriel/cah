<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsBlackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_black', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_to_draw');
            $table->integer('number_to_play');
            $table->text('text');
            $table->unsignedInteger('cardset_id');
            $table->foreign('cardset_id')->references('id')->on('cardsets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards_black');
    }
}
