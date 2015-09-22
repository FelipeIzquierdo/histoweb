<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function($table)
		{
            $table->increments('id');
			$table->string('doc', '100')->unique();
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();

			$table->string('email', 100)->nullable();
			$table->string('tel', 100)->nullable();
            $table->string('address', 100)->nullable();
			$table->enum('sex', ['M', 'F'])->nullable();
			$table->date('date_birth');
			$table->boolean('active')->default(false);

			$table->integer('doc_type_id')->unsigned();
		    $table->foreign('doc_type_id')->references('id')->on('doc_types');

            $table->integer('occupation_id')->unsigned();
            $table->foreign('occupation_id')->references('id')->on('occupations');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            
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
		Schema::drop('patients');
	}

}
