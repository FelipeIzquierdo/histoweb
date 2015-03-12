<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedEntriesHasReasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T34MOTIVODECONSULTAXPNA', function(Blueprint $table)
		{
			$table->increments('T34Id');
			$table->integer('T34CodIngreso')->unsigned();
		    $table->foreign('T34CodIngreso')->references('T32Id')->on('T32INGRESOSPORPERSONA');

		    $table->integer('T34CodMotivoConsulta')->unsigned();
		    $table->foreign('T34CodMotivoConsulta')->references('T15CodMotivoConsulta')->on('T15MOTIVODECONSULTA');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T34MOTIVODECONSULTAXPNA');
	}

}
