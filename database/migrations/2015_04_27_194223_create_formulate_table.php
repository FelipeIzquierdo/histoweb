<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formulate', function(Blueprint $table)
		{
			$table->increments('id');		
			$table->integer('entry_id')->unsigned();
            $table->foreign('entry_id')->references('id')->on('entries');
            $table->integer('generic_medication_id')->unsigned()->nullable();
            $table->foreign('generic_medication_id')->references('id')->on('generic_medications');
            $table->integer('commercial_medication_id')->unsigned()->nullable();
            $table->foreign('commercial_medication_id')->references('id')->on('commercial_medications');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->integer('diluent_id')->unsigned();
            $table->foreign('diluent_id')->references('id')->on('diluents');
            $table->integer('administration_route_presentation_id')->unsigned();
            $table->foreign('administration_route_presentation_id')->references('id')->on('generic_medications');
            $table->integer('concentration')->unsigned();
            $table->integer('dose')->unsigned();
            $table->string('interval');
            $table->string('limit');

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
		Schema::drop('formulate');
	}

}
