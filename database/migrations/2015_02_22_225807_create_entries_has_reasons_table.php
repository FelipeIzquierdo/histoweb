<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesHasReasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries_reasons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('admission_code')->unsigned();
		    $table->foreign('admission_code')->references('id')->on('entries');

		    $table->integer('code_reason')->unsigned();
		    $table->foreign('code_reason')->references('code_reason')->on('reasons');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entries_reasons');
	}

}
