<?php

class Chapter extends Eloquent
{

	public static $rules = array(
		'serie'     => 'not_in:0',
		'edizione'  => 'not_in:0',
		'titolo'    => 'required',
		'numero'    => 'required|integer',
		'file' 	    => 'required|max:15000',
		'cover'     => 'required|max:2048',
		'thumbnail' => 'required|max:2048',
	);

	public static $rules_update = array(
		'serie'    => 'not_in:0',
		'edizione' => 'not_in:0',
		'titolo'   => 'required',
		'numero'   => 'required|integer',
	);

	public static $messages = array(
		'serie_not_in' 	 	 => 'Scegli <strong>una serie</strong>!',
		'edizione_not_in'	 => "Scegli <strong>un'edizione</strong>!",
		'titolo_required'	 => 'Il <strong>titolo</strong> è obbligatorio',
		'numero_required'	 => 'Il <strong>numero del capitolo</strong> è obbligatorio',
		'numero_integer'  	 => 'Il <strong>numero del capitolo</strong> deve essere un numero',
		'file_required'	  	 => 'Devi caricare <strong>il file del capitolo</strong>!',
		'file_mimes'	  	 => 'Il <strong>file</strong> deve essere uno <strong>zip</strong>',
		'file_max'		  	 => 'Il <strong>file</strong> deve essere <strong>più piccolo di 10mb</strong>!',
		'cover_required'  	 => 'Devi caricare <strong>la cover del capitolo</strong>!',
		'cover_mimes'	  	 => 'La <strong>cover</strong> deve essere un\'immagine',
		'cover_max'		  	 => 'La <strong>cover</strong> deve essere <strong>più piccola di 2mb</strong>!',
		'thumbnail_required' => 'Devi caricare <strong>il thumbnail del capitolo</strong>!',
		'thumbnail_mimes'	 => 'Il <strong>thumbnail</strong> deve essere un\'immagine',
		'thumbnail_max'		 => 'Il <strong>thumbnail</strong> deve essere <strong>più piccolo di 2mb</strong>!',
	);

	public function edition()
	{
		return $this->belongs_to('Edition');
	}

	public function series()
	{
		return $this->belongs_to('Series');
	}

	public static function validate_chapter( $data )
	{
		return Validator::make($data, self::$rules, self::$messages);
	}

	public static function validate_chapter_update( $data )
	{
		return Validator::make($data, self::$rules_update, self::$messages);
	}

	/**
	 * Get a single chapter from ID
	 * @param int $id
	 * @return object
	 */
	public static function get_chapter_from_id( $id )
	{
		return self::where('id', '=', $id)->first();
	}

	/**
	 * Get the last {$num} chapters with series and edition info [for pagination]
	 * @param int $num
	 * @return array of objects
	 */
	public static function get_chapters_with_series_and_edition($num)
	{
		return self::with( array('series', 'edition') )->order_by('id', 'desc')->paginate($num);
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
		$query = self::with('edition')->where('chapter_num', '=', $id)->first();

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

	public static function insert_chapter($edition_id, $series_id, $chapter_num, $cover, $thumbnail, $title)
	{
		return self::create(array(
			'edition_id' 	=> $edition_id,
			'series_id' 	=> $series_id,
			'chapter_num'   => $chapter_num,
			'title' 		=> $title,
			'cover' 		=> $cover,
			'thumbnail' 	=> $thumbnail
		));
	}
}