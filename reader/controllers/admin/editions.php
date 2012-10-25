<?php

class Admin_Editions_Controller extends Base_Controller {

	/**
     * Editions index (tabella con elenco)
     * @return View
     */
    public function action_index()
    {
        $editions = Edition::get_editions(); // recupera tutte le edizioni
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

    /**
     * Form per la chiusura di un'edizione
     * @param integer $id
     * @return View
     */
    public function action_close( $id )
    {
        return View::make('admin.editions.close_edition_form')->with('id', $id);
    }

    /**
     * Processa il form per la chiusura dell'edizione
     * @param integer $id
     * @return Redirect
     */
    public function action_process( $id )
    {
        // azione che processa il form per la chiusura blabla
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
    }

}