<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	
	Schema::create('histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('history_type_id')->unsigned();
            $table->foreign('history_type_id')->references('id')->on('history_types');
			
			$table->timestamps();
			$table->unique(['name', 'history_type_id']);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('histories');
	}

}
