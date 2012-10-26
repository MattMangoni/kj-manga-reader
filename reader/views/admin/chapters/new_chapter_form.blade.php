@layout('layouts.admin')

@section('content')
	<h2>Aggiungi un capitolo</h2>

	@if($errors->has())
		<div class="alert alert-error">
			{{ $errors->first('serie', ':message<br />') }}
			{{ $errors->first('edizione', ':message<br />') }}
			{{ $errors->first('titolo', ':message<br />') }}
			{{ $errors->first('numero', ':message<br />') }}
			{{ $errors->first('file', ':message<br />') }}
		</div>
	@endif

	{{ Session::get('status') }}

	{{ Form::open_for_files('admin/chapters/create', 'POST') }}
	{{ Form::token() }}

	{{ Form::label('serie', 'Serie') }}
	{{ Form::select('serie', $series) }}<br />

	{{ Form::label('edizione', 'Edizione') }}
	{{ Form::select('edizione', $editions) }}<br />

	{{ Form::label('titolo', 'Titolo capitolo') }}
	{{ Form::text('titolo', '', array('class' => 'span4', 'placeholder' => "Inserisci il nome dell'edizione...")) }}<br />

	{{ Form::label('numero', 'Numero capitolo') }}
	{{ Form::text('numero', '', array('class' => 'span1')) }}<br /><br />

	{{ Form::label('file', 'Carica il file zip') }}
	{{ Form::file('file') }}
	<br /><br />

	{{ Form::submit("Inserisci il capitolo", array('class' => 'btn btn-success btn-large')) }}

	{{ Form::close() }}
@endsection