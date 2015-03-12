<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedMembershipTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T001TIPOAFILIACION', function(Blueprint $table)
		{
			$table->increments('T001CodTipoAfiliacion');
			$table->string('T001Tipo')->unique();
			$table->boolean('T001Borrable')->nullable()->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T001TIPOAFILIACION');
	}

}
