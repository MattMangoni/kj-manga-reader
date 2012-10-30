<?php

class Admin_Editions_Controller extends Base_Controller {

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }

	/**
     * Editions index (tabella con elenco)
     * @return View
     */
	public function action_index()
	{
        $editions = Edition::get_all_editions(); // recupera tutte le edizioni
        return View::make('admin.editions.editions_table')->with('editions', $editions);
    }

	/**
     * Form per aggiungere una nuova edizione
     * @return View
     */
	public function action_new()
	{
		return View::make('admin.editions.new_edition_form');
	}

    /**
     * Processa il form e inserisce l'edizione nel db
     * @return Redirect (?)
     */
    public function action_create()
    {
        $data     = Input::all(); // raccoglie tutti i dati inseriti
        $validate = Edition::validate_edition($data); // lancia la validazione dell'input

        if ($validate->valid()) // controlla se i dati sono validi
        {
            Edition::insert_edition(Input::get('nome')); // inserisce i dati nel DB
            return Redirect::to('admin/editions/new')
            ->with('status', '<div class="alert alert-success">Edizione inserita correttamente!</div>');
        }

        return Redirect::to('admin/editions/new')->with_errors($validate); // rimanda l'utente al forum se i dati non erano validi
    }

    public function action_activate( $id )
    {
        if (Edition::find($id)->first()->draft == 'yes')
        {
            $edition = Edition::find($id);
            $edition->draft = 'no';
            $edition->save();

            return Redirect::back()->with('status', '<div class="alert alert-success">Edizione attivata correttamente!</div>');
        }

        return Redirect::back()->with('status', '<div class="alert alert-error">Edizione disattivata correttamente!</div>');
    }

    public function action_deactivate( $id )
    {
        if (Edition::find($id)->first()->draft == 'no')
        {
            $edition = Edition::find($id);
            $edition->draft = 'yes';
            $edition->save();

            return Redirect::back()->with('status', '<div class="alert alert-success">Edizione disattivata correttamente!</div>');
        }

        return Redirect::back()->with('status', '<div class="alert alert-error">L\'edizione è già disattivata!</div>');
    }

    /**
     * Form per la chiusura di un'edizione
     * @param integer $id
     * @return View
     */
    public function action_close( $id )
    {
    	$edition_chapters = Chapter::get_chapters_from_edition($id);

    	$chapters[0] = "Scegli un vincitore";

    	foreach ($edition_chapters as $chapter) {
    		$chapters[$chapter->id] = $chapter->series->series_name . ' ' . 'Capitolo ' . $chapter->chapter_num;
    	}

    	return View::make('admin.editions.close_edition_form')
    		->with('id', $id)->with('chapters', $chapters);
    }

    /**
     * Processa il form per la chiusura dell'edizione
     * @param integer $id
     * @return Redirect
     */
    public function action_process( $id )
    {
        if (Input::get('vincitore') != 0)
        {
        	$series_id = Chapter::get_series_id_from_chapter(Input::get('vincitore'));
        	$winner_series_id = Series::get_series_from_id($series_id)->id;

        	$edition = Edition::find($id);
        	$edition->winner_chapter_id = Input::get('vincitore');
        	$edition->winner_series_id  = $winner_series_id;
        	$edition->status 			= 'Chiuso';
        	$edition->save();

        	return Redirect::back()->with('status', '<div class="alert alert-success">Edizione chiusa!</div>');
        }

        return Redirect::back()->with('status', '<div class="alert alert-error">Devi scegliere un vincitore!</div>');;
    }

    public function action_open( $id )
    {
    	$edition = Edition::get_edition($id)->status;

    	if ($edition == 'Chiuso')
    	{
    		$edition_to_open = Edition::find($id);
    		$edition_to_open->winner_chapter_id = '';
        	$edition_to_open->winner_series_id  = '';
        	$edition_to_open->status 			= 'Aperto';
        	$edition_to_open->save();

        	return Redirect::back();
    	}

    	return Redirect::to('admin/editions/');
    }

    /**
     * Mostra il form per la modifica dell'edizione
     * @param integer $id
     * @return View
     */
    public function action_edit( $id )
    {
        $edition = Edition::get_edition( $id ); // raccoglie i dati dell'edizione
        return View::make('admin.editions.edit_edition_form')
        ->with('edition', $edition);
    }

	/**
     * Processa il form per la modifica dell'edizione
     * @param integer $id
     * @return Redirect
     */
	public function action_update( $id )
	{
        $data     = Input::all(); // raccoglie tutti i dati inseriti
        $validate = Edition::validate_edition($data); // lancia la validazione dei dati

        if ($validate->valid()) // controlla se i dati inseriti sono validi
        {
            $edition = Edition::find($id); // raccoglie i dati dell'edizione
            $edition->name = Input::get('nome'); // aggiorna il nome dell'edizione
            $edition->save(); // salva sul DB

            return Redirect::to('admin/editions/edit/'.$id)
            ->with('status', '<div class="alert alert-success">Edizione aggiornata correttamente!</div>');
        }

        return Redirect::to('admin/editions/edit/'.$id)->with_errors($validate);
    }

    /**
     * Cancella l'edizione {$id}
     * @param integer $id
     * @return void
     */
    public function action_delete( $id )
    {
    	Edition::find($id)->delete();
        return Redirect::back()->with('status', '<div class="alert alert-success">Edizione eliminata!</div>');
    }

}