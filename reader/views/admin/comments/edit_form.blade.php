@layout('layouts/admin')

@section('content')

	<h2>Edita un commento (#{{ $comment->id }})</h2>

	@if($errors->has())
		<div class="alert alert-error">
			{{ $errors->first('nome', ':message<br />') }}
			{{ $errors->first('commento') }}
		</div>
	@endif

    {{ Session::get('status') }}

	{{ Form::open('admin/comments/update/'.$comment->id, 'POST') }}

	{{ Form::token() }}
	{{ Form::label('nome', 'Nome utente') }}
	{{ Form::text('nome', $comment->name, array('class' => 'span4', 'placeholder' => 'Inserisci il tuo nome...', 'value' => Input::old('name'))) }}
	{{ Form::label('commento', 'Commento') }}
	{{ Form::textarea('commento', $comment->comment, array('class' => 'span6', 'value' => Input::old('comment'))) }}<br /><br />

	{{ Form::submit('Inserisci il commento', array('class' => 'btn btn-primary btn-large')) }}

	{{ Form::close() }}
@endsection