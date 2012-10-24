<?php

class Series extends Eloquent
{
	public function edition()
	{
		return $this->belongs_to('Edition');
	}

	public function chapters()
	{
		return $this->has_many('Chapter');
	}

	public static function get_series()
	{
		return self::order_by('id', 'desc')->get();
	}

	/**
	 * Get last series id
	 * @return integer
	 */
	public static function get_last_series_id()
	{
		return self::order_by('id', 'desc')->first('series.id')->id;
	}

	/**
	 * Get series data from a slug
	 * @param string $slug
	 * @return object
	 */
	public static function get_series_from_slug($slug)
	{
		$query = self::where('slug', '=', $slug)->first();

		if ($query != null)
		{
			return $query;
		}
	}
}