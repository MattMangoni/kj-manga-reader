<?php

class Chapter extends Eloquent
{
	public function edition()
	{
		return $this->belongs_to('Edition');
	}

	public function series()
	{
		return $this->belongs_to('Series');
	}

	/**
	 * Get edition chapters
	 * @param string $type
	 * @param integer $id
	 * @return array of objects
	 */
	public static function get_chapters($type, $id)
	{
		if ($type == 'edition')
		{
			return self::with('series')->where($type.'_id', '=', $id)->get();
		}
		else
		{
			return self::with('edition')->where($type.'_id', '=', $id)->get();
		}

	}

	/**
	 * Get all the chapter for a given edition
	 * @param int $id
	 * @return array of objects
	 */
	public static function get_chapters_from_edition($id)
	{
		return self::with('series')->where('edition_id', '=', $id)->get();
	}

	/**
	 * Get chapter's and related edition's data
	 * @param integer $id
	 * @return object
	 */
	public static function get_chapter_with_edition($id)
	{
		$query = self::with('edition')->where('id', '=', $id)->first();

		if ($query != null)
		{
			return $query;
		}
	}

	public static function get_series_id_from_chapter($id)
	{
		return self::where('id', '=', $id)->first()->series_id;
	}

	/**
	 * Return an array with all the files in a directory
	 * @param string $directory
	 * @return array
	 */
	public static function get_directory_content($directory)
	{
		return Reader::scan_directory($directory);
	}

	/**
	 * Get the number of chapters of the last edition
	 * @param integer $id
	 * @return integer
	 */
	public static function get_last_edition_chapters_num($id)
	{
		return self::where('edition_id', '=', $id)->count();
	}
}