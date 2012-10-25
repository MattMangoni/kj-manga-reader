<?php

class Admin_Comments_Controller extends Base_Controller {

	public function __construct()
	{
        $this->filter('before', 'csrf')->on('post');
	}

	public function action_edit( $id )
	{
		$comment = Comment::get_comment_info($id);

		return View::make('admin.comments.edit_form')
		->with('comment', $comment);
	}

	public function action_update( $id )
	{
		$data     = Input::all();
		$validate = Comment::validate_admin($data);

		if ($validate->valid())
		{
			$comment          	 = Comment::find($id);
			$comment->name    	 = Input::get('nome');
			$comment->comment 	 = Input::get('commento');
			$comment->updated_at = date('Y-m-d H:i');
			$comment->save();

			return Redirect::to('admin/comments/edit/'.$id)
				->with('status', '<div class="alert alert-success">Commento aggiornato correttamente!</div>');
		}

		return Redirect::to('admin/comments/edit/'.$id)->with_errors($validate);
	}

	public function action_delete( $id )
	{
		Comment::delete_comment($id);

		return Redirect::back()->with('status', '<div class="alert alert-success">Commento cancellato con successo!</div>');
	}

}