<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryProcedureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entry_procedure', function(Blueprint $table)
        {
        	$table->integer('entry_id')->unsigned();
            $table->foreign('entry_id')->references('id')->on('entries');

            $table->integer('procedure_id')->unsigned();
            $table->foreign('procedure_id')->references('id')->on('procedures');
            
            $table->timestamps();
            $table->primary(['entry_id', 'procedure_id']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entry_procedure');
	}

}
