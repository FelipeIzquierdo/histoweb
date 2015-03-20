<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolSurgeryTable extends Migration {


	public function up()
	{
		Schema::create('tool_surgery', function(Blueprint $table)
        {
            $table->integer('tool_id')->unsigned();
            $table->foreign('tool_id')->references('id')->on('tools');

            $table->integer('surgery_id')->unsigned();
            $table->foreign('surgery_id')->references('id')->on('surgeries');
        });
	}

	public function down()
	{
		Schema::drop('tool_surgery');
	}

}

