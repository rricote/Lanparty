<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompeticionsUsuarisGrupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('competicions_users_grups', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('competicio_id');
            $table->integer('grupform_id');
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
        Schema::drop('competicions_users_grups');
	}

}