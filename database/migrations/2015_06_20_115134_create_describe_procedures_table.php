<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescribeProceduresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('describe_procedures', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('entry_id')->unsigned();
            $table->foreign('entry_id')->references('id')->on('entries');
            $table->date('start_date');
            $table->time('start_time');
            $table->time('end_time');

            $table->integer('surgery_id')->unsigned();
            $table->foreign('surgery_id')->references('id')->on('surgeries');

            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->integer('anesthesia_type_id')->unsigned();
            $table->foreign('anesthesia_type_id')->references('id')->on('anesthesia_types');

            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->references('id')->on('staff');

            $table->integer('way_entry_id')->unsigned();
            $table->foreign('way_entry_id')->references('id')->on('way_entries');

            $table->integer('state_way_id')->unsigned();
            $table->foreign('state_way_id')->references('id')->on('state_ways');

            $table->text('description')->nullable();
            $table->text('complications')->nullable();
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
		Schema::drop('describe_procedures');
	}

}