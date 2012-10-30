<?php

class Init {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('password');
		});

		Schema::create('editions', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('status');
			$table->string('winner_chapter_id')->default('');
			$table->string('winner_series_id')->default('');
			$table->string('draft')->default('yes');
			$table->timestamps();
		});

		Schema::create('chapters', function($table)
		{
			$table->increments('id');
			$table->integer('edition_id');
			$table->integer('series_id');
			$table->string('title');
			$table->integer('chapter_num');
			$table->string('thumbnail')->default('');
			$table->string('cover')->default('');
			$table->timestamps();
		});

		Schema::create('series', function($table)
		{
			$table->increments('id');
			$table->string('series_name');
			$table->string('author');
			$table->string('slug');
			$table->timestamps();
		});

		Schema::create('comments', function($table)
		{
			$table->increments('id');
			$table->integer('edition_id');
			$table->string('name');
			$table->text('comment');
			$table->timestamps();
		});

		DB::table('users')->insert(array(
			'username' => 'admin',
			'password' => Hash::make('secret'),
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('editions');
		Schema::drop('chapters');
		Schema::drop('series');
		Schema::drop('comments');
	}

}