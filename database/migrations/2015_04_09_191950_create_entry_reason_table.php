<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryReasonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entry_reason', function(Blueprint $table)
        {
        	$table->integer('entry_id')->unsigned();
            $table->foreign('entry_id')->references('id')->on('entries');

            $table->integer('reason_id')->unsigned();
            $table->foreign('reason_id')->references('id')->on('reasons');
            
            $table->timestamps();
            $table->primary(['entry_id', 'reason_id']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entry_reason');
	}

}
