<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedOccupationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T01OCUPACION', function(Blueprint $table)
		{
			$table->increments('T01CodOcupacion');
			$table->string('T01Tipo')->unique();
			$table->boolean('T01Borrable')->nullable()->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T01OCUPACION');
	}

}
