<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries', function(Blueprint $table)
		{
			$table->increments('id');
 			$table->integer('weight')->nullable();
 			$table->integer('height')->nullable();
            $table->integer('patient_entry_number');

			$table->integer('code_eps')->unsigned();
		    $table->foreign('code_eps')->references('code_eps')->on('eps');

		    $table->integer('code_regime')->unsigned();
		    $table->foreign('code_regime')->references('code_regime')->on('regimes');


		    $table->integer('code_membership')->unsigned();
		    $table->foreign('code_membership')->references('code_membership')->on('membership_types');

            $table->integer('patient_cc')->unsigned();
            $table->foreign('patient_cc')->references('cc')->on('patients');

            $table->unique(['patient_cc', 'patient_entry_number']);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entries');
	}

}
