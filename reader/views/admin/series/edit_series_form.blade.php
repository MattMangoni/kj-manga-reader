@layout('layouts.admin')

@section('content')
	<h2>Modifica una serie</h2>

	@if($errors->has())
		<div class="alert alert-error">
			{{ $errors->first('nome', ':message<br />') }}
			{{ $errors->first('autore') }}
		</div>
	@endif

	{{ Session::get('status') }}

	{{ Form::open('admin/series/update/'.$series->id, 'POST') }}
	{{ Form::token() }}

	{{ Form::label('nome', 'Nome Serie') }}
	{{ Form::text('nome', $series->series_name, array('class' => 'span4', 'placeholder' => "Inserisci il nome della serie...")) }}<br />

	{{ Form::label('autore', 'Nome Autore') }}
	{{ Form::text('autore', $series->author, array('class' => 'span4', 'placeholder' => "Inserisci il nome dell'autore...")) }}

	{{ Form::hidden('old_slug', $series->slug) }}

	<span class="help-inline">In caso di più autori inseriscili separati da una virgola</span>
	<br /><br />

	{{ Form::submit("Modifica la serie", array('class' => 'btn btn-success btn-large')) }}

	{{ Form::close() }}
@endsection