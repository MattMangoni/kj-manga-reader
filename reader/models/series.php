<?php

class Series extends Eloquent
{

	// regola di validazione
	public static $rules = array(
		'nome'   => 'required',
		'autore' => 'required',
	);

	// messaggi di errore validazione
	public static $messages = array(
		'nome_required'   => 'Il <strong>nome della serie</strong> è obbligatorio!',
		'autore_required' => 'Il <strong>nome dell\'autore</strong> è obbligatorio!',
	);

	public function edition()
	{
		return $this->belongs_to('Edition');
	}

	public function chapters()
	{
		return $this->has_many('Chapter');
	}

	// validazione form
	public static function validate_series($data)
	{
		return Validator::make($data, self::$rules, self::$messages);
	}

	/**
	 * Get all the series
	 * @return array of objects
	 */
	public static function get_series()
	{
		return self::with('chapters')->order_by('id', 'desc')->get();
	}

	/**
	 * Get last series id
	 * @return integer
	 */
	public static function get_last_series_id()
	{
		return self::order_by('id', 'desc')->first('series.id');
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

	/**
	 * Get the series data from ID
	 * @param int $id
	 * @return object
	 */
	public static function get_series_from_id($id)
	{
		return self::where('id', '=', $id)->first();
	}

	public static function insert_series($name, $author, $slug)
	{
		return self::create( array('series_name' => $name, 'author' => $author, 'slug' => $slug) );
	}
}