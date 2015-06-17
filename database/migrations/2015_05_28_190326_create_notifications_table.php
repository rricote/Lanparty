<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('notifications', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type');
            $table->integer('reason');
            $table->integer('interesat');
            $table->integer('destinatari');
            $table->integer('state');
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
        Schema::drop('notifications');
	}

}
