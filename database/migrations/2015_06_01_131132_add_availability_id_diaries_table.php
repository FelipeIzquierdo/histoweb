<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailabilityIdDiariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('diaries', function(Blueprint $table)
		{
			$table->integer('availability_id')->unsigned();
            $table->foreign('availability_id')->references('id')->on('availabilities');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('diaries', function(Blueprint $table)
		{
			$table->dropForeign('diaries_availability_id_foreign');
			$table->dropColumn('availability_id');
		});
	}

}
