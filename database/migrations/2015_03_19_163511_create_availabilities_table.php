<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailabilitiesTable extends Migration {


	public function up()
	{
		Schema::create('availabilities', function(Blueprint $table)
		{
			$table->increments('id');

            $table->timestamp('start');
            $table->timestamp('end');

            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');


			
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('availabilities');
	}

}
