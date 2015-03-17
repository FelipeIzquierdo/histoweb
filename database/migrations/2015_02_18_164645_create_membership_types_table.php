<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('membership_types', function(Blueprint $table)
		{
			$table->increments('code_membership');
			$table->string('type')->unique();
			$table->boolean('erasable')->nullable()->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('membership_types');
	}

}
