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
        $data     = Input::all();
        $validate = Edition::validate_edition($data);

        if ($validate->valid())
        {
            Edition::insert_edition(Input::get('nome'));
            return Redirect::to('admin/editions/new')
                ->with('status', '<div class="alert alert-success">Edizione inserita correttamente!</div>');
        }

        return Redirect::to('admin/editions/new')->with_errors($validate);
    }

    public function action_close( $id )
    {
        return View::make('admin.editions.close_edition_form')->with('id', $id);
    }

    public function action_process( $id )
    {
        // azione che processa il form per la chiusura blabla
    }

	public function action_edit( $id )
    {
        $edition = Edition::get_edition( $id );
        return View::make('admin.editions.edit_edition_form')
            ->with('edition', $edition);
    }

	public function action_update( $id )
    {
        $data     = Input::all();
        $validate = Edition::validate_edition($data);

        if ($validate->valid())
        {
            $edition = Edition::find($id);
            $edition->name = Input::get('nome');
            $edition->save();

            return Redirect::to('admin/editions/edit/'.$id)
                ->with('status', '<div class="alert alert-success">Edizione aggiornata correttamente!</div>');
        }

        return Redirect::to('admin/editions/edit/'.$id)->with_errors($validate);
    }

	public function action_delete( $id )
    {
        Edition::find($id)->delete();
    }

}