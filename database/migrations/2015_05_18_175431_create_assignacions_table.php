<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignacionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('assignacions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('motiu_id');
            $table->integer('premi_id');
            $table->integer('edicio_id');
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
        Schema::drop('assignacions');
	}

}
