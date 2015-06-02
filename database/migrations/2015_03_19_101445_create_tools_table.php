<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration {


	public function up()
	{
		Schema::create('tools', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
	}


	public function down()
	{
        Schema::drop('tools');
	}

}
