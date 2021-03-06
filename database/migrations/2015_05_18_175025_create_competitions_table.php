<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('competitions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->string('imatge');
            $table->string('number');
            $table->integer('state');
            $table->string('link');
            $table->timestamp('data_inici');
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
        Schema::drop('competitions');
	}

}
