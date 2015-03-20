<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaReasonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agenda_reason', function(Blueprint $table)
		{

			$table->integer('agenda_id')->unsigned();
		    $table->foreign('agenda_id')->references('id')->on('agendas');

		    $table->integer('reason_id')->unsigned();
		    $table->foreign('reason_id')->references('id')->on('reasons');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('agenda_reason');
	}

}
