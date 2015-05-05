<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceduresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('procedures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cod')->unique();
			$table->string('name')->unique();

			$table->integer('procedure_type_id')->unsigned();
            $table->foreign('procedure_type_id')->references('id')->on('procedure_types');

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
		Schema::drop('procedures');
	}

}