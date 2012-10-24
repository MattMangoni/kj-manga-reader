<?php

class Home_Controller extends Base_Controller {

	public $restful = true;
    public static $last_edition_id;

    public function __construct()
    {
        self::$last_edition_id = Edition::get_last_edition()->id;
    }

	/**
     * Website index
     * @return View
     */
    public function get_index()
    {
        $active_page      = 'index';
        $last_edition     = Edition::get_last_edition(); // get last edition data
        $chapter_list     = Chapter::get_chapters('edition', self::$last_edition_id); // get edition's chapters list
        $get_last_winners = Edition::get_winners(3); // get last 3 edition's winners

        return View::make('home.index')
            ->with('active',       $active_page)
            ->with('last_edition', $last_edition)
            ->with('chapters',     $chapter_list)
            ->with('winners',      $get_last_winners);
    }

    /**
     * Submit comment form
     * @return View
     */
    public function post_index()
    {
        $data     = Input::all();
        $validate = Comment::validate($data);

        if ($validate->valid())
        {
            Comment::insert_comment(self::$last_edition_id, Input::get('name'), Input::get('comment'));
        }
        else
        {
            return Redirect::to('/')->with_errors($validate);
        }

        return Redirect::to('/');
    }

    /**
     * Sezione edizioni
     * @return View
     */
	public function get_editions( $edition = NULL )
    {
        $active_page      = 'editions';
        $last_edition_id  = Edition::get_last_edition_id();

        if (! is_numeric($edition) or $edition == NULL)
        {
            return Redirect::to('edizioni/'.$last_edition_id);
        }

        $get_editions = Edition::get_editions(); // get all editions
        $get_chapters = Chapter::get_chapters('edition', $edition); // get edition's chapters
        $get_comments = Comment::get_comments($edition); // get edition's comments

        return View::make('home.editions')
            ->with('active',   $active_page)
            ->with('editions', $get_editions)
            ->with('current',  $edition)
            ->with('chapters', $get_chapters)
            ->with('comments', $get_comments);
    }

    /**
     * Sezione dedicata alle serie
     * @return View
     */
    public function get_series( $id = NULL )
    {
        $active_page    = 'series';
        $last_series_id = Series::get_last_series_id();

        if (! is_numeric($id))
        {
            return Redirect::to('serie/'.$last_series_id);
        }

        $get_series   = Series::get_series(); // get all series
        $get_chapters = Chapter::get_chapters('series', $id); // get all chapters from a series

        return View::make('home.series')
            ->with('active',   $active_page)
            ->with('current',  $id)
            ->with('series',   $get_series)
            ->with('chapters', $get_chapters);
    }

	/**
     * Sezione vincitori
     * @return View
     */
    public function get_winners()
    {
        $active_page         = 'winners';
        $get_closed_editions = Edition::get_closed_editions();

        return View::make('home.winners')
            ->with('active'  , $active_page)
            ->with('editions', $get_closed_editions);
    }
}