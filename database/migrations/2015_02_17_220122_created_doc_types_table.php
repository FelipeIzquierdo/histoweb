<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedDocTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T023TIPODOCID', function(Blueprint $table)
		{
			$table->increments('T023CodTipo');
			$table->string('T023Tipo')->unique();
			$table->boolean('T023Borrable')->nullable()->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T023TIPODOCID');
	}
}
