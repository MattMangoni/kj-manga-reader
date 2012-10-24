@layout('layouts.default')

@section('sidebar')

<div class="container">
	<div class="row">

 <div class="span4">
    <h3>Ultimi vincitori</h3>
    <p>Qui potete trovare un elenco degli ultimi vincitori delle edizioni concluse del Manga Project. Dategli un'occhiata!</p>
    <br />
    <ul class="thumbnails">
      @foreach($winners as $winner)
      <li class="span4">
        <h5>{{ $winner->series_name }} capitolo {{ $winner->chapter_num }} ({{ $winner->name }})</h5><br />
        <a href="{{ URL::home() }}read/{{ $winner->slug }}/{{ $winner->chapter_num }}" class="btn btn-block">Leggi il capitolo</a>
        <a href="#" class="btn btn-block">Scarica il capitolo</a>
      </li>
      @endforeach
    </ul>
    <div class="alert alert-important">Per vedere tutti i vincitori, <a href="{{ URL::home() }}vincitori/">clicca qui</a></div>
  </div>
@endsection

@section('main')
  <div class="span8">

        <h1>
        	Ultima edizione <small>{{ $last_edition->name }}</small>
        	@if($last_edition->status == 'Aperto')
        		<span class="label label-success">Aperta</span>
        	@else
        		<span class="label label-important">Chiusa</span>
        	@endif
        </h1>

        <table class="table table-striped">
          <thead>
            <th>Serie</th>
            <th>Capitolo</th>
            <th>Titolo capitolo</th>
          </thead>
          <tbody>
            <tr>
            @foreach($chapters as $chapter)
              <td>{{ $chapter->series->series_name }}</td>
              <td>Capitolo {{ $chapter->chapter_num }}</td>
              <td>{{ $chapter->title }}</td>
              <td><a href="{{ URL::home() }}read/{{ $chapter->series->slug }}/{{ $chapter->chapter_num }}">Leggi online</a></td>
              <td><a href="#">Scarica</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <br />
        <h3>Ultimi commenti di quest'edizione</h3>
        <br />
        <div id="comments-container">

          @foreach($last_edition->comments as $comment)

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
        </div>

        <div id="comment-form">
          <h3>Inserisci un commento</h3>
          <br />

          {{ Form::open() }}

          {{ Form::token() }}
          {{ Form::label('name', 'Nome utente') }}
          {{ Form::text('name', '', array('class' => 'span4', 'placeholder' => 'Inserisci il tuo nome...')) }}
          {{ Form::label('comment', 'Commento') }}
          {{ Form::textarea('comment', '', array('class' => 'span8')) }}
          {{ Form::text('captcha', '', array('class' => 'captchainput', 'placeholder' => 'Inserisci il captcha...')) }}
          {{ Form::image(CoolCaptcha\Captcha::img(), 'captcha', array('class' => 'captchaimg')) }}<br /><br />

          {{ Form::submit('Inserisci il commento', array('class' => 'btn btn-primary btn-large')) }}

          {{ Form::close() }}

        </div>

        <div class="alert alert-important">Per vedere i dettagli di tutte le edizioni del Komixjam Manga Project,
          <a href="{{ URL::home() }}edizioni">clicca qui</a></div>
      </div>

	</div>
</div>
@endsection

