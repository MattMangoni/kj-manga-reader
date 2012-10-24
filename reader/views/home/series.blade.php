@layout('layouts.default')

@section('main')

<div class="container">
	<div class="row">
		<div class="span3">
			<ul>
				@foreach($series as $series)
					<li>
						@if($series->id == $current)
							{{ $series->series_name }}
						@else
							<a href="{{ URL::home() }}serie/{{ $series->id }}">{{ $series->series_name }}</a>
						@endif
					</li>
				@endforeach
			</ul>
		</div>

		<div class="span9">
			<table class="table table-striped">
				<thead>
					<th>Capitolo</th>
					<th>Titolo capitolo</th>
					<th>Edizione</th>
				</thead>
				<tbody>
					@foreach($chapters as $chapter)
					<tr>
						<td>Capitolo {{ $chapter->chapter_num }}</td>
						<td>{{ $chapter->title }}</td>
						<td>{{ $chapter->edition->name }}</td>
						<td><a href="#">Leggi online</a></td>
						<td><a href="#">Scarica</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection