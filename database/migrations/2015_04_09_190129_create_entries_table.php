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

            $table->timestamp('exit_at')->nullable();

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
