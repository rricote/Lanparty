<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompeticionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('competicions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->string('imatge');
            $table->string('number');
            $table->integer('estat');
            $table->string('link');
            $table->timestamp('data_inici');
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
        Schema::drop('competicions');
	}

}
