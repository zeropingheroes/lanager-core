<?php

use Illuminate\Database\Migrations\Migration;

class CreateSteamStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('steam_states', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('username',32);
			$table->integer('status_code');
			$table->integer('app_id')->nullable();
			$table->string('app_name')->nullable();
			$table->string('server_ip')->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('steam_states');
	}

}