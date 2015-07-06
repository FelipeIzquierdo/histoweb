<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrationRoutesPresentationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('administration_route_presentations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('route_id')->unsigned();
			$table->foreign('route_id')->references('id')->on('administration_routes');
			$table->integer('presentation_id')->unsigned();
			$table->foreign('presentation_id')->references('id')->on('presentations');	
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
		Schema::drop('administration_route_presentations');
	}

}
