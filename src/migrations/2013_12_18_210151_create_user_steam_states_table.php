<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserSteamStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_steam_states', function($table)
		{
			$table->increments('id');
			$table->string('steam_id_64', 17);
			$table->string('username',32);
			$table->integer('status_code');
			$table->integer('app_id')->nullable();
			$table->string('app_name')->nullable();
			$table->string('server_ip')->nullable();
			$table->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_steam_states');
	}

}