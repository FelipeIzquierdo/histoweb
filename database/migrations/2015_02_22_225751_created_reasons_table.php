<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedReasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T15MOTIVODECONSULTA', function(Blueprint $table)
		{
			$table->increments('T15CodMotivoConsulta');
			$table->string('T15Tipo')->unique();
			$table->boolean('T15Borrable')->nullable()->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T15MOTIVODECONSULTA');
	}

}
