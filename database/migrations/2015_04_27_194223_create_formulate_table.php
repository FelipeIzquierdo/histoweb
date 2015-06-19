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
            $table->integer('commercial_medication_id')->unsigned();
            $table->foreign('commercial_medication_id')->references('id')->on('commercial_medications');
            $table->integer('presentation_id')->unsigned();
            $table->foreign('presentation_id')->references('id')->on('presentations');	
            $table->integer('concentration_id')->unsigned();
            $table->foreign('concentration_id')->references('id')->on('concentrations');
            $table->integer('administration_route_id')->unsigned();
            $table->foreign('administration_route_id')->references('id')->on('administration_routes');
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
