<?php

class Comment extends Eloquent
{
	public static $timestamp = true; // set the updated_at field to update automatically

	public static $rules = array(
		'nome' 	   => 'required',
		'commento' => 'required',
		'captcha'  => 'coolcaptcha|required'
	);

	public static $messages = array(
		'required' => 'Il campo <strong>:attribute</strong> è obbligatorio.',
    	'coolcaptcha' => 'Captcha errato',
    );

	public static function validate( $data )
	{
		return Validator::make($data, self::$rules, self::$messages);
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
		return static::where('edition_id', '=', $id)->order_by('id', 'desc')->paginate(5);
	}

	public static function insert_comment($edition_id, $name, $comment)
	{
		self::create(array('edition_id' => $edition_id, 'name' => $name, 'comment' => $comment, 'chapter_id' => 0, 'series_id' => 0));
	}
}