<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicaments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('description');

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
		Schema::drop('medicaments');
	}

}
