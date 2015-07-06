<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialMedicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commercial_medications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cod')->unique();
			$table->string('name')->unique();
			$table->string('description')->nullable();

			$table->integer('generic_medication_id')->unsigned();
            $table->foreign('generic_medication_id')->references('id')->on('generic_medications');

            $table->integer('lab_id')->unsigned();
            $table->foreign('lab_id')->references('id')->on('labs');

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
		Schema::drop('commercial_medications');
	}

}
