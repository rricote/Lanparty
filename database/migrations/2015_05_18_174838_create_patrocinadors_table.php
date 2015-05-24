<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatrocinadorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('patrocinadors', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->integer('tipus');
            $table->string('logo');
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
        Schema::drop('patrocinadors');
	}

}
