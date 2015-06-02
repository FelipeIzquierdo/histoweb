<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryDiagnosesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entry_diagnoses', function(Blueprint $table)
        {
        	$table->integer('entry_id')->unsigned();
            $table->foreign('entry_id')->references('id')->on('entries');

            $table->integer('diagnosis_id')->unsigned();
            $table->foreign('diagnosis_id')->references('id')->on('diagnoses');
            
            $table->timestamps();
            $table->primary(['entry_id', 'diagnosis_id']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entry_diagnoses');
	}

}
