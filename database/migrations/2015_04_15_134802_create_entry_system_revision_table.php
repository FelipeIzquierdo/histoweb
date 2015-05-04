<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrySystemRevisionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entry_system_revision', function(Blueprint $table)
        {
        	$table->integer('entry_id')->unsigned();
            $table->foreign('entry_id')->references('id')->on('entries');

            $table->integer('system_revision_id')->unsigned();
            $table->foreign('system_revision_id')->references('id')->on('system_revisions');
            
            $table->timestamps();
            $table->primary(['entry_id', 'system_revision_id']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entry_system_revision');
	}

}
