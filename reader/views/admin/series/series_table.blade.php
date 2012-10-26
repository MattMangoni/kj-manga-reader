@layout('layouts.admin')

@section('content')

	<h2>Elenco Serie</h2>

	{{ Session::get('status') }}

	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Edizione</th>
			<th>Autore</th>
			<th>Capitoli</th>
		</thead>
		<tbody>
			@foreach($series as $series)
				<tr>
					<td>{{ $series->id }}</td>
					<td>{{ $series->series_name }}</td>
					<td>{{ $series->author }}</td>
					<td>{{ $series->chapters()->count() }}</td>
					<td>{{ HTML::link('admin/series/edit/'.$series->id, 'Modifica', array('class' => 'btn')) }}</td>
					<td>{{ HTML::link('admin/series/delete/'.$series->id, 'Elimina', array('class' => 'btn btn-danger')) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ HTML::link('admin/series/new', 'Aggiungi una nuova serie', array('class' => 'btn btn-success')) }}<br /><br />
@endsection