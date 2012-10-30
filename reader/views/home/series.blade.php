@layout('layouts.default')

@section('main')

<div class="container">
		<div class="row">
	        <div class="span12">
	    		<div class="page-header">
            		<h1>Elenco Serie <small>Elenco di tutte le serie che partecipano o hanno partecipato al Manga Project</small></h1>
          		</div>
          	</div>
    	</div>

	<div class="row">
		<div class="span3">
			<ul>
			@if($series)
				@foreach($series as $series)
					<li>
						@if($series->id == $current)
							{{ $series->series_name }}
						@else
							<a href="{{ URL::home() }}serie/{{ $series->id }}">{{ $series->series_name }}</a>
						@endif
					</li>
				@endforeach
			@else
				<li>Nessuna serie disponibile</li>
			@endif
			</ul>
		</div>

		<div class="span9">
		@if(isset($current_series))
			<table class="table">
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
				              <td class="span1"><a class="btn btn-small" href="{{ URL::home() }}read/{{ $chapter->series->slug }}/{{ $chapter->chapter_num }}">Leggi</a></td>
				              <td class="span1">
				                <a class="btn btn-small" href="{{ URL::home() }}uploads/{{ $chapter->series->slug }}/{{ $chapter->series->series_name }}_Capitolo_{{ $chapter->chapter_num }}.zip">
				                  Scarica
				                </a>
				              </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="alert">&larr; Per visualizzare i dettagli di una serie sceglila nella barra sulla sinistra</div>
		@endif
		</div>
	</div>
</div>

@endsection