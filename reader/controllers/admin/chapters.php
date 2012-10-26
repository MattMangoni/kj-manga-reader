<?php

class Admin_Chapters_Controller extends Base_Controller {

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
            $upload_path   = path('public') . 'uploads' . DIRECTORY_SEPARATOR . $series->slug; // path in cui carica lo zip
            $full_name     = $upload_path . DIRECTORY_SEPARATOR . $series->series_name . '_Capitolo_' . $chapter_num . '.zip'; // nome del file zip
            $unzipped_path = $upload_path . DIRECTORY_SEPARATOR . $chapter_num; // path in cui scompattare lo zip

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

	public function action_edit()
    {
        echo "Edit non disponibile... cancellare ed inserire nuovamente il capitolo";
    }

	public function action_update()
    {

    }

	public function action_delete( $id )
    {
        // cancella il capitolo
    }

}