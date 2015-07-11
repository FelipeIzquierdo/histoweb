<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcentrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('concentrations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('diluent_amount')->unsigned();
			$table->integer('unit_amount')->unsigned();
			$table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->integer('presentation_id')->unsigned();
			$table->foreign('presentation_id')->references('id')->on('presentations');	
			$table->integer('diluent_id')->unsigned();
            $table->foreign('diluent_id')->references('id')->on('diluents');
            $table->integer('generic_medication_id')->unsigned();
            $table->foreign('generic_medication_id')->references('id')->on('generic_medications');

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('concentrations');
	}

}
