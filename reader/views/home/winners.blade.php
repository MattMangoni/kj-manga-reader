@layout('layouts.default')

@section('main')
	<div class="container">
		<div class="row">
			<div class="span12">
				@foreach($editions as $edition)
					<h1>{{ $edition->name }}</h1>
					<h3>Vincitore</h3>
					<p>
						{{ $edition->series_name }} capitolo {{ $edition->chapter_num }}<br />
						Titolo: {{ $edition->title }}<br />
						Autore: {{ $edition->author }}<br />
					</p>
				@endforeach
			</div>
		</div>
	</div>
@endsection