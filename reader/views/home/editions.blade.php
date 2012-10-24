@layout('layouts.default')

@section('main')

<div class="container">
	<div class="row">
		<div class="span3">
			<ul>
				@foreach($editions as $edition)
					<li>
					@if($edition->id == $current)
						{{ $edition->name }}
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

			@if(! $comments)
				<p>Non ci sono commenti per questa edizione</p>
			@else
				@foreach($comments as $comment)
		          <?php
		              $date = date('d/m/Y', strtotime($comment->created_at));
		              $time = date('H:m', strtotime($comment->created_at));
		            ?>

		            <div id="comments">
		              <p>
		                Pubblicato da <strong>{{ $comment->name }}</strong>
		                il <strong>{{ $date }}</strong> alle <strong>{{ $time }}</strong>
		              </p>

		              <p>{{ $comment->comment }}</p><br />
		            </div>
				@endforeach
			@endif
		</div>
	</div>
</div>
@endsection