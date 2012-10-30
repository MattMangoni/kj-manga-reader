@layout('layouts.default')

@section('main')
	<div class="container">
		<div class="row">
			<div class="span12">
				@foreach($editions as $edition)
					<div class="page-header">
						<h1>{{ $edition->name }}</h1>
					</div>
					<div class="row">
						<img src="http://placehold.it/960x160" class="span12">
					</div>

					<h3>Vincitore</h3>

					<table class="table">
						<thead>
							<th>Serie</th>
							<th>Capitolo</th>
							<th>Titolo</th>
							<th>Autore</th>
						</thead>
						<tbody>
							<tr>
								<td>{{ $edition->series_name }}</td>
								<td>{{ $edition->chapter_num }}</td>
								<td>{{ $edition->title }}</td>
								<td>{{ $edition->author }}</td>
								<td class="span1"><a class="btn btn-small" href="#">Leggi</a></td>
								<td class="span1"><a class="btn btn-small" href="#">Scarica</a></td>
							</tr>
						</tbody>
					</table>
				@endforeach
			</div>
		</div>
	</div>
@endsection