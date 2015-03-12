<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('T32INGRESOSPORPERSONA', function(Blueprint $table)
		{
			$table->increments('T32Id');
			$table->integer('T32ConsecIngreso');
 			$table->integer('T32PesoenKilos')->nullable();
 			$table->integer('T32TallaenCms')->nullable();

		    $table->integer('T32CC')->unsigned();
		    $table->foreign('T32CC')->references('T31CC')->on('T31IDENTIFICACION');

			$table->integer('T32CodEps')->unsigned();
		    $table->foreign('T32CodEps')->references('T04CodEps')->on('T04EPS');

		    $table->integer('T32CodRegimen')->unsigned();
		    $table->foreign('T32CodRegimen')->references('T94CodRegimen')->on('T94REGIMEN');

		    $table->integer('T32CodOcupacion')->unsigned();
		    $table->foreign('T32CodOcupacion')->references('T01CodOcupacion')->on('T01OCUPACION');

		    $table->integer('T32CodTipoAfiliacion')->unsigned();
		    $table->foreign('T32CodTipoAfiliacion')->references('T001CodTipoAfiliacion')->on('T001TIPOAFILIACION');
			
		    $table->unique(['T32CC', 'T32ConsecIngreso']);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('T32INGRESOSPORPERSONA');
	}

}
