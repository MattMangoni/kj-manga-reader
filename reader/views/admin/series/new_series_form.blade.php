@layout('layouts.admin')

@section('content')
	<h2>Aggiungi una serie</h2>

	@if($errors->has())
		<div class="alert alert-error">
			{{ $errors->first('nome', ':message<br />') }}
			{{ $errors->first('autore') }}
		</div>
	@endif

	{{ Session::get('status') }}

	{{ Form::open('admin/series/create', 'POST') }}
	{{ Form::token() }}

	{{ Form::label('nome', 'Nome Serie') }}
	{{ Form::text('nome', '', array('class' => 'span4', 'placeholder' => "Inserisci il nome della serie...")) }}<br />

	{{ Form::label('autore', 'Nome Autore') }}
	{{ Form::text('autore', '', array('class' => 'span4', 'placeholder' => "Inserisci il nome dell'autore...")) }}
	<span class="help-inline">In caso di più autori inseriscili separati da una virgola</span>
	<br /><br />

	{{ Form::submit("Inserisci la serie", array('class' => 'btn btn-success btn-large')) }}

	{{ Form::close() }}
@endsection