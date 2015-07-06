<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericMedicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('generic_medications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cod')->unique();
			$table->string('name')->unique();
			$table->string('description')->nullable();

			$table->integer('administration_route_presentation_id')->unsigned();
            $table->foreign('administration_route_presentation_id')->references('id')->on('administration_route_presentations');
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
		Schema::drop('generic_medications');
	}

}
