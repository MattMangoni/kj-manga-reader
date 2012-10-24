<?php

class Admin_Controller extends Base_Controller {

	public $restful = true;

    public function __construct() {
        $this->filter('before', 'csrf')->on('post');
    }

	public function get_index()
    {
    	$last_edition 			= Edition::get_last_edition();
    	$last_edition_chapters  = Chapter::get_last_edition_chapters_num($last_edition->id);
    	$series_num	  			= Series::count();
    	$chapter_num  			= Chapter::count();

    	return View::make('admin.index')
    		->with('edition', 	  				$last_edition)
    		->with('last_edition_chapters_num', $last_edition_chapters)
    		->with('series_num',  				$series_num)
    		->with('chapter_num', 				$chapter_num);
    }

    public function get_login()
    {
        if (Auth::guest())
            return View::make('admin.login');
        else
            return Redirect::to('admin');
    }

    public function post_login()
    {
        $data       = Input::all();
        $validation = User::validate($data);

        if ($validation->fails()) return Redirect::to('login')->with_errors($validation);

        $credentials = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($credentials)) {
            return Redirect::to('admin')
                ->with('data', $credentials);
        } else {
            return Redirect::to('login');
        }
    }
}