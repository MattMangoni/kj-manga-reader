<?php

class Comment extends Eloquent
{
	public static $timestamp = true;

	// user validation rules
	public static $rules = array(
		'nome' 	   => 'required',
		'commento' => 'required',
		'captcha'  => 'coolcaptcha|required'
	);

	// user validation messages
	public static $messages = array(
		'required' => 'Il campo <strong>:attribute</strong> è obbligatorio.',
    	'coolcaptcha' => 'Captcha errato',
    );

	// admin validation rules (without captcha)
	public static $rules_admin = array(
		'nome' 	   => 'required',
		'commento' => 'required',
	);

	// admin validation messages (without captcha)
    public static $messages_admin = array(
    	'required' => 'Il campo <strong>:attribute</strong> è obbligatorio.',
    );

    // user input validation
	public static function validate( $data )
	{
		return Validator::make($data, self::$rules, self::$messages);
	}

	// admin input validation
	public static function validate_admin( $data )
	{
		return Validator::make($data, self::$rules_admin, self::$messages_admin);
	}

	/* RELATIONSHIP(S) */
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
		return self::where('edition_id', '=', $id)->order_by('id', 'desc')->paginate(5);
	}

	public static function get_comment_info($id)
	{
		return self::where('id', '=', $id)->first();
	}

	public static function insert_comment($edition_id, $name, $comment)
	{
		self::create(array('edition_id' => $edition_id, 'name' => $name, 'comment' => $comment));
	}

	public static function delete_comment($id)
	{
		self::find($id)->delete();
	}
}