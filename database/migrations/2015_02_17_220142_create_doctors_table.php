<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration {


	public function up()
	{
		Schema::create('doctors', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('cc')->unsigned()->unique();
			
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
            
            $table->string('color', 8)->nullable();
            $table->boolean('telemedicine')->default(false);
            
            $table->integer('specialty_id');
            $table->foreign('specialty_id')->references('id')->on('specialties');
            
            $table->timestamps();
        });
	}


	public function down()
	{
		Schema::drop('doctors');
	}

}
