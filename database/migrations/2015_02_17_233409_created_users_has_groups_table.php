<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedUsersHasGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('TZ4USUARIOSXGRUPO', function(Blueprint $table)
		{
			$table->integer('Tz4CodUsuario')->unsigned();
		    $table->foreign('Tz4CodUsuario')->references('Tz3CodUsuario')->on('TZ3USUARIOS');

		    $table->integer('Tz4CodGrupo')->unsigned();
		    $table->foreign('Tz4CodGrupo')->references('Tz2CodGrupo')->on('TZ2GRUPOS');

		    $table->primary(['Tz4CodUsuario', 'Tz4CodGrupo']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('TZ4USUARIOSXGRUPO');
	}

}
