<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedPatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T31IDENTIFICACION', function(Blueprint $table)
		{
			$table->integer('T31CC');
			$table->string('T31Nombre', 50)->nullable();
			$table->string('T31SegundoNombre', 50)->nullable();
			$table->string('T31PrimerApellido', 50)->nullable();
			$table->string('T31SegundoApellido', 50)->nullable();

			$table->string('T31Sexo', 9)->nullable();
			$table->dateTime('T32FechaNacimiento');
			$table->boolean('T31Activo')->default(true);

			$table->integer('T31CodTipoDocId')->unsigned();
		    $table->foreign('T31CodTipoDocId')->references('T023CodTipo')->on('T023TIPODOCID');

		    $table->primary('T31CC');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T31IDENTIFICACION');
	}

}
