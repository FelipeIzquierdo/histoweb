<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscardedAvailabilityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('discarded_availability', function(Blueprint $table)
        {
            $table->integer('availability_id')->unsigned();
            $table->foreign('availability_id')->references('id')->on('availabilities');

            $table->integer('surgery_id')->unsigned();
            $table->foreign('surgery_id')->references('id')->on('surgeries');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('discarded_availability');
	}

}
