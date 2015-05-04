<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurgeryToolTable extends Migration {


	public function up()
	{
		Schema::create('surgery_tool', function(Blueprint $table)
        {
        	$table->integer('surgery_id')->unsigned();
            $table->foreign('surgery_id')->references('id')->on('surgeries');

            $table->integer('tool_id')->unsigned();
            $table->foreign('tool_id')->references('id')->on('tools');
            
            $table->timestamps();
            $table->primary(['surgery_id', 'tool_id']);
        });
	}

	public function down()
	{
		Schema::drop('surgery_tool');
	}

}

