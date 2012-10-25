@layout('layouts.admin')

@section('content')
	<h2>Chiudi l'edizione</h2>

	@if($errors->has())
		<div class="alert alert-error">
			{{ $errors->first('nome') }}
		</div>
	@endif
	{{ Session::get('status') }}

	{{ Form::open('admin/editions/process/'.$id, 'POST') }}
	{{ Form::token() }}

	{{ Form::label('vincitore', 'Vincitore Edizione') }}
	{{ Form::select('vincitore', array(0 => 'Scegli il vincitore', 1 => "Up! Capitolo 2")) }}<br /><br />

	{{ Form::submit("Procedi", array('class' => 'btn btn-inverse btn-large')) }}

	{{ Form::close() }}
@endsection