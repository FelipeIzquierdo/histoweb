<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration {


	public function up()
	{
		Schema::create('schedules', function(Blueprint $table)
		{
            $table->increments('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('days');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->integer('surgery_id')->unsigned();
            $table->foreign('surgery_id')->references('id')->on('surgeries');

            $table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('schedules');
	}

}
