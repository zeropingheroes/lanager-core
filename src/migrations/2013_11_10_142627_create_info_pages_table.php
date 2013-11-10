<?php

use Illuminate\Database\Migrations\Migration;

class CreateInfoPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('info_pages', function($table)
		{
			$table->increments('id');
			$table->integer('parent_id')->nullable()->unsigned();
			$table->string('title');
			$table->text('content')->nullable();
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
		Schema::drop('info_pages');
	}

}