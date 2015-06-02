<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('diaries', function(Blueprint $table)
        {
        	$table->increments('id');
        	
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');

            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('diary_types');

            $table->integer('eps_id')->unsigned();
            $table->foreign('eps_id')->references('id')->on('eps');

            $table->integer('membership_types_id')->unsigned();
            $table->foreign('membership_types_id')->references('id')->on('membership_types');

            $table->timestamp('start');
            $table->timestamp('end');

            $table->timestamp('entered_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            
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
        Schema::drop('diaries');
	}

}
