<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('notificacions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('tipus');
            $table->integer('rao');
            $table->integer('interesat');
            $table->integer('destinatari');
            $table->integer('estat');
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
        Schema::drop('notificacions');
	}

}
