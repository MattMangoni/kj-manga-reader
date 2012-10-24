<?php

class User extends Eloquent
{
	public static $rules = array(
		'username' => 'required',
		'password' => 'required'
	);

	public static function validate( $data )
	{
		return Validator::make($data, self::$rules);
	}
}