<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration {


	public function up()
	{
		Schema::create('doctors', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('cc')->unsigned();
			$table->string('fist_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
            $table->integer('specialties_id')->unsigned();
            $table->foreign('specialties_id')->references('id')->on('specialties');
            $table->timestamps();
        });
	}


	public function down()
	{
		Schema::drop('doctors');
	}

}
