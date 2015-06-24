<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffProfessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

    public function up()
    {
        Schema::create('profession_staff', function(Blueprint $table)
        {
            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->references('id')->on('staff');

            $table->string('profession_id',12);
            $table->foreign('profession_id')->references('id')->on('professions');

            $table->timestamps();
            $table->primary(['staff_id', 'profession_id']);
        });
    }

    public function down()
    {
        Schema::drop('profession_staff');
    }

}
