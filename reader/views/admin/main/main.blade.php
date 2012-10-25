@layout('layouts.admin')

@section('content')
<div class="hero-unit">
	<h1>Statistiche</h1>
	<br />
	<p>
		Ultima edizione: {{ $edition->name }} ({{ $edition->status }})<br />
		Serie totali: {{ $series_num }}<br />
		Capitoli ultima edizione: {{ $last_edition_chapters_num }}<br />
		Capitoli totali caricati: {{ $chapter_num }}
	</p>
	<br />
</div>
@endsection