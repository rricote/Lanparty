<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('assignments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('motive_id');
            $table->integer('present_id');
            $table->integer('edition_id');
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
        Schema::drop('assignments');
	}

}
