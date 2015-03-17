<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_user', function(Blueprint $table)
		{
			$table->integer('code_user')->unsigned();
		    //$table->foreign('code_user')->references('Tz3CodUsuario')->on('TZ3USUARIOS');

		    $table->integer('code_group')->unsigned();
		    //$table->foreign('code_group')->references('Tz2CodGrupo')->on('TZ2GRUPOS');

		    $table->primary(['code_user', 'code_group']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_user');
	}

}
