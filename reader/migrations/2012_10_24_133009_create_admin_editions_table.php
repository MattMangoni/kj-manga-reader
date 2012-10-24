<?php

class Create_Admin_Editions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('admin_editions', function($table)
		{
			$table->increments('id');

			$table->string('name');
			$table->string('status');
			$table->chapter_id('winner');
			$table->integer('winner_series_id');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_editions');
	}

}