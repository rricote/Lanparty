<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsUsuarisGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('competitions_users_groups', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('competition_id');
            $table->integer('group_id');
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
        Schema::drop('competitions_users_groups');
	}

}
