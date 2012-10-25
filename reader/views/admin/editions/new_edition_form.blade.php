@layout('layouts.admin')

@section('content')
	<h2>Aggiungi un'edizione</h2>

	@if($errors->has())
		<div class="alert alert-error">
			{{ $errors->first('nome') }}
		</div>
	@endif

	{{ Session::get('status') }}

	{{ Form::open('admin/editions/create', 'POST') }}
	{{ Form::token() }}

	{{ Form::label('nome', 'Nome edizione') }}
	{{ Form::text('nome', '', array('class' => 'span4', 'placeholder' => "Inserisci il nome dell'edizione...")) }}<br /><br />

	{{ Form::submit("Inserisci l'edizione", array('class' => 'btn btn-success btn-large')) }}

	{{ Form::close() }}
@endsection