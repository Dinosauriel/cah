<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->boolean('is_admin')->default(0);
			$table->boolean('is_temporary');
			$table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('api_token', 128)->unique();
			$table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('cardset_game');
        Schema::dropIfExists('players');
    }
}
