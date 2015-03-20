<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('cc')->unsigned();
			$table->string('fist_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();

			$table->string('sex', 9)->nullable();
			$table->dateTime('date_birth');
			$table->boolean('active')->default(true);

			$table->integer('doc_type_id')->unsigned();
		    $table->foreign('doc_type_id')->references('id')->on('doc_types');

            $table->integer('occupation_id')->unsigned();
            $table->foreign('occupation_id')->references('id')->on('occupations');

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
		Schema::drop('patients');
	}

}
