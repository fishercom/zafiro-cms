<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsRegistersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_registers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_id')->unsigned();
			$table->integer('contact_id')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('dni')->nullable();
			$table->string('address')->nullable();
			$table->string('city')->nullable();
			$table->string('phone', 50)->nullable();
			$table->string('email')->nullable();
			$table->string('comments', 4000)->nullable();
			$table->boolean('checkin')->nullable();
			$table->boolean('review')->nullable();
			$table->dateTime('review_date')->nullable();
			$table->timestamps();

			$table->foreign('form_id')
				  ->references('id')
				  ->on('cms_forms');// ->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cms_registers');
	}

}
