@layout('layouts.default')

@section('main')

<div class="container">
		<div class="row">
	        <div class="span12">
	    		<div class="page-header">
            		<h1>Elenco edizioni <small>Elenco di tutte le edizioni, passate a presenti, del Manga Project</small></h1>
          		</div>
          	</div>
    	</div>
    	<div class="row">
			<div class="span3">
				<ul>
					@foreach($editions as $edition)
						<li>
						@if($edition->id == $current)
							{{ $edition->name }}
							@if($edition->status == 'Aperto')
								<span class="label label-success">Aperta</span>
							@else
								<span class="label label-important">Chiusa</span>
							@endif
						@else
							<a href="{{ URL::home() }}edizioni/{{ $edition->id }}">{{ $edition->name }}</a>
						@endif
						</li>
					@endforeach
				</ul>
			</div>

			<div class="span9">
				<table class="table table-striped">
					<thead>
						<th>Serie</th>
						<th>Capitolo</th>
						<th>Titolo capitolo</th>
					</thead>
					<tbody>
						@foreach($chapters as $chapter)
						<tr>
							<td>{{ $chapter->series->series_name }}</td>
							<td>Capitolo {{ $chapter->chapter_num }}</td>
							<td>{{ $chapter->title }}</td>
							<td><a href="#">Leggi online</a></td>
							<td><a href="#">Scarica</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<h4>Ultimi commenti</h4>
				<br />

				@if(! $comments->results)
					<p>Non ci sono commenti per questa edizione</p>
				@else
	        <div id="comments-container">

	            <div id="comments">

	              @foreach($comments->results as $comment)
	                <div id="comment">
	                  <?php
	                    $date = date('d/m/Y', strtotime($comment->created_at));
	                    $time = date('H:i', strtotime($comment->created_at));
	                  ?>
	                  <p>
	                    Pubblicato da <strong>{{ $comment->name }}</strong>
	                    il <strong>{{ $date }}</strong> alle <strong>{{ $time }}</strong>
	                  </p>
	                  <p>{{ $comment->comment }}</p><br />
	                </div>
	              @endforeach

	            </div>

	           {{ $comments->links() }}
	        </div>
				@endif
		</div>
	</div>
</div>
@endsection