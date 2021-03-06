<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('dni');
            $table->string('name');
            $table->string('surname1');
            $table->string('surname2');
            $table->string('username')->unique();
            $table->string('ultratoken');
			$table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('state_id');
            $table->integer('rol_id');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
