@layout('layouts.default')

@section('main')
	<div class="container">
		<div class="row">
			<div class="span12">
			@if($editions)
				@foreach($editions as $edition)
					<div class="page-header">
						<h1>{{ $edition->name }}</h1>
					</div>
					<div class="row">
						<img src="{{ URL::home() }}uploads/{{ $edition->slug }}/images/{{ $edition->cover }}" class="span12">
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
			@else
				<h2>Nessun vincitore presente nel database.</h2>
			@endif
			</div>
		</div>
	</div>
@endsection