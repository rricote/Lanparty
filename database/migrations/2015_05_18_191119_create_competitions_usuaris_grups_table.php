<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsUsuarisGrupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('competitions_users_grups', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('competicio_id');
            $table->integer('grup_id');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('competitions_users_grups');
	}

}
