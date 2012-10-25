<?php

class Admin_Editions_Controller extends Base_Controller {

	public function action_index()
    {
        $editions = Edition::get_editions(); // recupera tutte le edizioni

        return View::make('admin.editions.editions_table')->with('editions', $editions);
    }

	public function action_new()
    {
        return View::make('admin.editions.new_edition_form');
    }

	public function action_create()
    {
        // processa il form della nuova edizione
    }

	public function action_edit()
    {
        // form per aggiornare un'edizione
    }

	public function action_update()
    {
        // processa il form per l'aggiornamento di un'edizione
    }

	public function action_delete()
    {
        // elimina una edizione (non dovrebbe servire :P)
    }

}