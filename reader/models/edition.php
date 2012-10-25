<?php

class Edition extends Eloquent
{
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
	 * Get last edition data
	 * @return object
	 */
	public static function get_last_edition()
	{
		return self::order_by('id', 'desc')->first();
	}

	/**
	 * Get the ID of the last edition
	 * @return integer
	 */
	public static function get_last_edition_id()
	{
		return self::order_by('id', 'desc')->first('editions.id')->id;
	}

	/**
	 * Get data from all editions
	 * @return array of objects
	 */
	public static function get_editions()
	{
		return self::with('chapters')->order_by('id', 'desc')->get();
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
}