<?php

class Admin_Chapters_Controller extends Base_Controller {

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }

	public function action_index()
    {
        $chapters = Chapter::get_chapters_with_series_and_edition(8);
        return View::make('admin.chapters.chapters_table')->with('chapters', $chapters);
    }

	public function action_new()
    {
        $series_array[0]  = "Scegli una serie";
        $edition_array[0] = "Scegli un'edizione";

        $all_series   = Series::get_series();
        $all_editions = Edition::get_editions();

        foreach($all_series as $series)
        {
            $series_array[$series->id] = $series->series_name;
        }

        foreach ($all_editions as $editions)
        {
            $edition_array[$editions->id] = $editions->name;
        }

        return View::make('admin.chapters.new_chapter_form')
            ->with('editions', $edition_array)->with('series', $series_array);
    }

	public function action_create()
    {
        $data = Input::all();
        $validate = Chapter::validate_chapter($data);

        if ($validate->valid())
        {
            // raccolgo gli input
            $edition_id  = Input::get('edizione');
            $series_id   = Input::get('serie');
            $chapter_num = Input::get('numero');
            $title       = Input::get('titolo');

            // prendo i dati della serie a cui appartiene il capitolo (mi serve lo slug ed il nome)
            $series = Series::get_series_from_id($series_id);

            // costruisco i path per l'upload e per l'estrazione dallo zip
            $upload_path   = path('public') . 'uploads' . DS . $series->slug; // path in cui carica lo zip
            $full_name     = $upload_path . DS . $series->series_name . '_Capitolo_' . $chapter_num . '.zip'; // nome del file zip
            $unzipped_path = $upload_path . DS . $chapter_num; // path in cui scompattare lo zip

            // carico il file sul server
            Input::upload('file', $upload_path, $series->series_name . '_Capitolo_' . $chapter_num . '.zip');

            // scompatto il file nella cartella del capitolo
            Reader::unzip($full_name, $unzipped_path);

            // inserisco i dati nel DB
            Chapter::insert_chapter($edition_id, $series_id, $chapter_num, $title);

            return Redirect::back()->with('status', '<div class="alert alert-success">Capitolo inserito correttamente!</div>');
        }

        return Redirect::back()->with_errors($validate);
    }

	public function action_edit( $id )
    {
        $chapter = Chapter::get_chapter_from_id($id);

        $series_array[0]  = "Scegli una serie";
        $edition_array[0] = "Scegli un'edizione";

        $all_series   = Series::get_series();
        $all_editions = Edition::get_editions();

        foreach($all_series as $series)
        {
            $series_array[$series->id] = $series->series_name;
        }

        foreach ($all_editions as $editions)
        {
            $edition_array[$editions->id] = $editions->name;
        }

        return View::make('admin.chapters.edit_chapter_form')
            ->with('chapter', $chapter)->with('series', $series_array)->with('editions', $edition_array);
    }

	public function action_update( $id )
    {
        $data = Input::all();
        $validate = Chapter::validate_chapter_update($data);

        if ($validate->valid())
        {
            // raccolgo gli input
            $edition_id      = Input::get('edizione');
            $series_id       = Input::get('serie');
            $chapter_num     = Input::get('numero');
            $old_chapter_num = Input::get('old_chapter_num');
            $title           = Input::get('titolo');

            // get series data
            $series = Series::get_series_from_id($series_id);
            $slug = $series->slug;
            $series_name = $series->series_name;

            // path cartella capitolo
            $path = path('public').'uploads'.DS.$slug.DS;

            // path zip capitolo prima della modifica
            $old_chapter_path = $path.$series->series_name . '_Capitolo_' . $old_chapter_num . '.zip';

            // nuovo path capitolo
            $chapter_path = $path.$series->series_name . '_Capitolo_' . $chapter_num . '.zip';

            // rinomina la cartella del capitolo e lo zip
            rename($path.$old_chapter_num, $path.$chapter_num);
            rename($old_chapter_path, $chapter_path);


            $chapter = Chapter::find($id);
            $chapter->edition_id  = $edition_id;
            $chapter->series_id   = $series_id;
            $chapter->chapter_num = $chapter_num;
            $chapter->title       = $title;
            $chapter->save();

            return Redirect::back()->with('status', '<div class="alert alert-success">Capitolo aggiornato correttamente!</div>');
        }

        return Redirect::back()->with_errors($validate);
    }

	public function action_delete( $id )
    {
        $chapter = Chapter::get_chapter_from_id($id);
        $series = Series::get_series_from_id($chapter->series_id);
        $series_name = $series->series_name;
        $slug = $series->slug;
        $chapter_num = $chapter->chapter_num;
        $path_directory = path('public').'uploads'.DS.$slug.DS;
        $path_zip = $path_directory.$series->series_name . '_Capitolo_' . $chapter_num . '.zip';

        if ( is_dir($path_directory.$chapter_num) )
        {
            File::rmdir($path_directory.$chapter_num);
            File::delete($path_zip);
            Chapter::find($id)->delete();

            return Redirect::back()->with('status', '<div class="alert alert-success">Capitolo cancellato!</div>');
        }

        return Redirect::back()->with('status', '<div class="alert alert-error">Impossibile cancellare il capitolo</div>');
    }

}