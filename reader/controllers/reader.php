<?php

class Reader_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index($slug = null, $chapter_id = null, $page = null)
	{
		// check if the slug and the chapter id are set
		if ($slug == null or !is_numeric($chapter_id))
		{
			return Redirect::to('/'); // if not, redirect the user to the home page
		}

		// check if a page number has been specified in the url
		if ($page == null)
		{
			return Redirect::to('read/'.$slug.'/'.$chapter_id.'/1'); // if not, take the user to the first page
		}

		$active_page = '';

		// get series and chapter data using the slug and the chapter id
		// if nothing is found, both functions will return "null"
		$series  = Series::get_series_from_slug($slug);
		$chapter = Chapter::get_chapter_with_edition($chapter_id);

		// this will check if the series OR chapter are not found
		// if so, redirects the user to the home page
		if ($series == null or $chapter == null)
		{
			return Redirect::to('/');
		}

		// build the path for the image
		$directory = path('public').'uploads'.DIRECTORY_SEPARATOR.$slug.DIRECTORY_SEPARATOR.$chapter_id;
		// create an array containing all the filenames from the specified path
		$files = Chapter::get_directory_content($directory);

		sort($files);

		return View::make('reader.reader')
			->with('active',  	   $active_page)
			->with('current_page', $page)
			->with('files',		   $files)
			->with('series',  	   $series)
			->with('chapter', 	   $chapter);
	}
}