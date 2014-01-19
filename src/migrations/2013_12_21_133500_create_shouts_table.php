<?php

use Illuminate\Database\Migrations\Migration;

class CreateShoutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shouts', function($table)
		{		
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('content');
			$table->boolean('pinned');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->on_update('cascade')->on_delete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shouts');
	}

}