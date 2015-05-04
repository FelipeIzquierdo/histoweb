<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration {

	public function up()
	{
		Schema::create('agendas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');


 			$table->integer('weight')->nullable();
 			$table->integer('height')->nullable();
            $table->integer('patient_entry_number');
			$table->integer('eps_id')->unsigned();
		    $table->foreign('eps_id')->references('id')->on('eps');
		    $table->integer('regime_id')->unsigned();
		    $table->foreign('regime_id')->references('id')->on('regimes');
		    $table->integer('membership_id')->unsigned();
		    $table->foreign('membership_id')->references('id')->on('membership_types');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('agendas');
	}

}
