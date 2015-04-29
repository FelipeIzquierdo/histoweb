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
            $table->integer('medicament_id')->unsigned();
            $table->foreign('medicament_id')->references('id')->on('medicaments');
            $table->integer('presentation_id')->unsigned();
            $table->foreign('presentation_id')->references('id')->on('presentations');	
            $table->integer('via_medicament_id')->unsigned();
            $table->foreign('via_medicament_id')->references('id')->on('via_medicaments');
            $table->integer('concentration')->unsigned();
            $table->integer('measure_id')->unsigned();
            $table->foreign('measure_id')->references('id')->on('measures');
            $table->integer('quantity')->unsigned();
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
