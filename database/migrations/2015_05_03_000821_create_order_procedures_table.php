<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProceduresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_procedures', function(Blueprint $table)
		{
			$table->increments('id');		
			
			$table->integer('entry_id')->unsigned();
            $table->foreign('entry_id')->references('id')->on('entries');
            
            $table->integer('procedure_id')->unsigned();
            $table->foreign('procedure_id')->references('id')->on('procedures');
            
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
		Schema::drop('order_procedures');
	}

}
