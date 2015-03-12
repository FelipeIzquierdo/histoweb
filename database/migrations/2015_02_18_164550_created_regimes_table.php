<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedRegimesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T94REGIMEN', function(Blueprint $table)
		{
			$table->increments('T94CodRegimen');
			$table->string('T94Tipo')->unique();
			$table->boolean('T94Borrable')->nullable()->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T94REGIMEN');
	}

}
