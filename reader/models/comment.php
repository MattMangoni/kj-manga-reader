<?php

class Comment extends Eloquent
{
	public static $timestamp = true; // set the updated_at field to update automatically

	public static $rules = array(
		'name' 	  => 'required',
		'comment' => 'required',
	);

	public function validate()
	{

	}

	public function edition()
	{
		return $this->belongs_to('Edition');
	}

	/**
	 * Get edition's comments
	 * @param integer $id
	 * @return array of objects
	 */
	public static function get_comments($id)
	{
		return static::where('edition_id', '=', $id)->get();
	}
}