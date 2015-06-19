<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrationRoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('administration_routes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('description')->nullable();

			$table->integer('presentation_id')->unsigned();
            $table->foreign('presentation_id')->references('id')->on('presentations');

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
		Schema::drop('administration_routes');
	}

}

