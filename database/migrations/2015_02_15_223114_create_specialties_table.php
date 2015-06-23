<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialtiesTable extends Migration {


	public function up()
	{
		Schema::create('specialties',function(Blueprint $table)
        {
        	$table->integer('id')->primary();
            $table->string('name');
            $table->timestamps();
        });
	}


	public function down()
	{
		Schema::drop('specialties');
	}

}
