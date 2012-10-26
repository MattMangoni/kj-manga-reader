@layout('layouts.admin')

@section('content')
<h2>Elenco Capitoli</h2>

{{ Session::get('status') }}

<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Serie</th>
		<th>#</th>
		<th>Titolo</th>
		<th>Edizione</th>
	</thead>
	<tbody>
		@foreach($chapters->results as $chapter)
			<tr>
				<td>{{ $chapter->id }}</td>
				<td>{{ $chapter->series->series_name }}</td>
				<td>{{ $chapter->chapter_num }}</td>
				<td>{{ $chapter->title }}</td>
				<td>{{ $chapter->edition->name }}</td>
				<td>{{ HTML::link('admin/chapters/edit/'.$chapter->id, 'Modifica', array('class' => 'btn')) }}</td>
				<td>{{ HTML::link('admin/chapters/delete/'.$chapter->id, 'Elimina', array('class' => 'btn btn-danger')) }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

{{ $chapters->links(); }}

{{ HTML::link('admin/chapters/new', 'Aggiungi un nuovo capitolo', array('class' => 'btn btn-success')) }}<br /><br />
@endsection