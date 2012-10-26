<?php

class Admin_Series_Controller extends Base_Controller {

	public function action_index()
    {
        $series = Series::get_series();
        return View::make('admin.series.series_table')->with('series', $series);
    }

	public function action_new()
    {
        return View::make('admin.series.new_series_form');
    }

	public function action_create()
    {
        $data = Input::all();
        $validate = Series::validate_series($data);

        if ($validate->valid())
        {
            $slug = Reader::to_slug( Input::get('nome') );

            if (Reader::create_chapter_dir($slug))
            {
                Series::insert_series( Input::get('nome'), Input::get('autore'), $slug );
            }
            else
            {
                return Redirect::back()->with('status', '<div class="alert alert-error">Impossibile creare la cartella!</div>');
            }

            return Redirect::back()->with('status', '<div class="alert alert-success">Serie inserita correttamente!</div>');
        }

        return Redirect::back()->with_errors($validate);
    }

	public function action_edit( $id )
    {
        $series = Series::get_series_from_id($id);
        return View::make('admin.series.edit_series_form')->with('series', $series);
    }

	public function action_update( $id )
    {
        $data = Input::all();
        $validate = Series::validate_series($data);

        if ($validate->valid())
        {
            $slug     = Reader::to_slug( Input::get('nome') );
            $old_slug = Input::get('old_slug');
            $path     = path('public').'uploads'.DIRECTORY_SEPARATOR;

            if ( is_dir($path.$old_slug) )
            {
                rename($path.DIRECTORY_SEPARATOR.$old_slug, $path.DIRECTORY_SEPARATOR.$slug);

                $series = Series::find($id);
                $series->series_name = Input::get('nome');
                $series->author      = Input::get('autore');
                $series->slug        = $slug;
                $series->save();

                return Redirect::back()->with('status', '<div class="alert alert-success">Serie aggiornata correttamente!</div>');
            }

            return Redirect::back()->with('status', '<div class="alert alert-error">Impossibile rinominare la cartella!</div>');
        }

        return Redirect::back()->with_errors($validate);
    }

	public function action_delete( $id )
    {
        $series   = Series::get_series_from_id($id);
        $path     = path('public').'uploads'.DIRECTORY_SEPARATOR.$series->slug;

        if( is_dir($path) )
        {
            rmdir($path);
            Series::find($id)->delete();
            return Redirect::back()->with('status', '<div class="alert alert-success">Serie cancellata!</div>');
        }

        return Redirect::back()->with('status', '<div class="alert alert-error">ERRORE: serie non rimossa!</div>');
    }
}