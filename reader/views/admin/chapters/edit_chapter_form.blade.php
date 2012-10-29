@layout('layouts.admin')

@section('content')
	<h2>Modifica un capitolo</h2>

	@if($errors->has())
		<div class="alert alert-error">
			{{ $errors->first('serie', ':message<br />') }}
			{{ $errors->first('edizione', ':message<br />') }}
			{{ $errors->first('titolo', ':message<br />') }}
			{{ $errors->first('numero', ':message<br />') }}
		</div>
	@endif

	{{ Session::get('status') }}

	{{ Form::open_for_files('admin/chapters/update/'.$chapter->id, 'POST') }}
	{{ Form::token() }}

	{{ Form::label('serie', 'Serie') }}
	{{ Form::select('serie', $series) }}<br />

	{{ Form::label('edizione', 'Edizione') }}
	{{ Form::select('edizione', $editions) }}<br />

	{{ Form::label('titolo', 'Titolo capitolo') }}
	{{ Form::text('titolo', $chapter->title, array('class' => 'span4', 'placeholder' => "Inserisci il nome dell'edizione...")) }}<br />

	{{ Form::label('numero', 'Numero capitolo') }}
	{{ Form::text('numero', $chapter->chapter_num, array('class' => 'span1')) }}<br /><br />

	{{ Form::hidden('old_chapter_num', $chapter->chapter_num) }}

	{{ Form::submit("Aggiorna il capitolo", array('class' => 'btn btn-success btn-large')) }}

	{{ Form::close() }}
@endsection