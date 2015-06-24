<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWayEntriesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('way_entries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->text('description')->nullable();
			$table->string('code')->unique();
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
		Schema::drop('way_entries');
	}

}
