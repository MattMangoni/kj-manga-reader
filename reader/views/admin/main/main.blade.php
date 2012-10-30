@layout('layouts.admin')

@section('content')
<div class="hero-unit">
	<h1>Statistiche</h1>
	<br />
	<p>
		@if($edition)
			Ultima edizione: {{ $edition->name }} ({{ $edition->status }})<br />
			Serie totali: {{ $series_num }}<br />
			Capitoli ultima edizione: {{ $last_edition_chapters_num }}<br />
			Capitoli totali caricati: {{ $chapter_num }}
		@else
			Nessuna statistica disponibile
		@endif
	</p>
	<br />
</div>
@endsection