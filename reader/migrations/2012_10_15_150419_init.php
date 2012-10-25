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
			$table->timestamps();
		});

		Schema::create('editions', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('status');
			$table->string('winner_chapter_id')->default('');
			$table->string('winner_series_id')->default('');
			$table->timestamps();
		});

		Schema::create('chapters', function($table)
		{
			$table->increments('id');
			$table->integer('edition_id');
			$table->integer('series_id');
			$table->string('title');
			$table->integer('chapter_num');
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
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('editions')->insert(array(
			'name'      		=> 'Luglio 2012',
			'status'    		=> 'Chiuso',
			'winner_chapter_id' => 1,
			'winner_series_id'	=> 1,
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('editions')->insert(array(
			'name'   			=> 'Ottobre 2012',
			'status' 			=> 'Aperto',
			'winner_chapter_id' => '',
			'winner_series_id'	=> '',
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('series')->insert(array(
			'series_name' => 'Up!',
			'author'      => 'Lonewolf',
			'slug'		  => 'up',
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('chapters')->insert(array(
			'edition_id'  => 1,
			'series_id'   => 1,
			'title'		  => 'Prologo',
			'chapter_num' => 1,
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('chapters')->insert(array(
			'edition_id'  => 2,
			'series_id'   => 1,
			'title'		  => 'Il mostro verde',
			'chapter_num' => 2,
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('chapters')->insert(array(
			'edition_id'  => 2,
			'series_id'   => 1,
			'title'		  => 'Il mostro blu',
			'chapter_num' => 3,
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('chapters')->insert(array(
			'edition_id'  => 2,
			'series_id'   => 1,
			'title'		  => 'La patata fritta',
			'chapter_num' => 4,
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('comments')->insert(array(
			'edition_id' => 2,
			'name'		 => 'Giggi',
			'comment'	 => 'Ottimo capitolo!',
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('comments')->insert(array(
			'edition_id' => 2,
			'name'		 => 'Francesco',
			'comment'	 => 'Non mi è piaciuto molto...',
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
		));

		DB::table('comments')->insert(array(
			'edition_id' => 2,
			'name'		 => 'Giggi',
			'comment'	 => 'Ottimo capitolo!',
			'created_at' => date('Y-m-d H:i'),
			'updated_at' => date('Y-m-d H:i')
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