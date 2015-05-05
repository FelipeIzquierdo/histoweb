<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->boolean('active')->default(true);
            $table->text('present_illness');
            $table->text('management_plan');

            $table->integer('eps_id')->unsigned();
            $table->foreign('eps_id')->references('id')->on('eps');
            $table->integer('membership_types_id')->unsigned();
            $table->foreign('membership_types_id')->references('id')->on('membership_types');
            $table->integer('diary_id')->unsigned();
            $table->foreign('diary_id')->references('id')->on('diaries');

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
		Schema::drop('entries');
	}

}
