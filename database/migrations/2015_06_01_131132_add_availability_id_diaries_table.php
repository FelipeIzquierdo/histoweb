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

            $table->integer('surgery_id')->unsigned()->nullable();
            $table->foreign('surgery_id')->references('id')->on('surgeries');
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

			$table->dropForeign('diaries_surgery_id_foreign');
			$table->dropColumn('surgery_id');
		});
	}

}
