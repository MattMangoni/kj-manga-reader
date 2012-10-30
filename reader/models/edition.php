<?php

class Edition extends Eloquent
{
	// validation rules
	public static $rules = array(
		'nome' => 'required',
	);

	// validation error messages
	public static $messages = array(
		'nome_required' => 'Il campo <strong>nome edizione</strong> è obbligatorio.',
	);

	public function series()
	{
		return $this->has_many('Series');
	}

	public function comments()
	{
		return $this->has_many('Comment')->order_by('id', 'desc');
	}

	public function chapters()
	{
		return $this->has_many('Chapter');
	}

	/**
	 * Validating the user input
	 * @param validation $data
	 * @return type
	 */
	public static function validate_edition( $data )
	{
		return Validator::make($data, self::$rules, self::$messages);
	}

	/**
	 * Get single edition informations
	 * @param integer $id
	 * @return object
	 */
	public static function get_edition( $id )
	{
		return self::where('id', '=', $id)->first();
	}

	/**
	 * Get data from all editions
	 * @return array of objects
	 */
	public static function get_editions()
	{
		return self::with('chapters')->where('draft', '=', 'no')->order_by('id', 'desc')->get();
	}

	public static function get_all_editions()
	{
		return self::with('chapters')->order_by('id', 'desc')->get();
	}

	/**
	 * Get last edition data
	 * @return object
	 */
	public static function get_last_edition()
	{
		return self::where('draft', '=', 'no')->order_by('id', 'desc')->first();
	}

	/**
	 * Get the ID of the last edition
	 * @return integer
	 */
	public static function get_last_edition_id()
	{
		return self::where('draft', '=', 'no')->order_by('id', 'desc')->first('editions.id')->id;
	}

	/**
	 * Joining all data for the closed editions (for winners etc)
	 * @return ?
	 */
	public static function get_closed_editions_prep()
	{
		return DB::table('editions')
		->join('chapters', 'editions.winner_chapter_id', '=', 'chapters.id')
		->join('series', 'editions.winner_series_id', '=', 'series.id');
	}

	/**
	 * Get all closed editions
	 * @return array of objects
	 */
	public static function get_closed_editions()
	{
		return self::get_closed_editions_prep()->get();
	}

	/**
	 * Get last {$num} closed editions
	 * @param integer $num
	 * @return array of objects
	 */
	public static function get_winners($num)
	{
		return self::get_closed_editions_prep()->take($num)->get();
	}

	public static function insert_edition($name)
	{
		return self::create(array('name' => $name, 'status' => 'Aperto', 'winner_series_id' => '', 'winner_chapter_id' => ''));
	}
}