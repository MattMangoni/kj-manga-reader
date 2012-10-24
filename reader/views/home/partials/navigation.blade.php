    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="{{ URL::home() }}">Komixjam Manga Project</a>
          <ul class="nav pull-right">
            <li><a href="http://www.komixjam.it" target="_blank">&larr; Visita Komixjam.it</a></li>
          </ul>
          <div class="nav-collapse">
            <ul class="nav">
              <li
                @if($active == 'editions')
                  class="active"
                @endif
              ><a href="{{ URL::home() }}edizioni" id="tipsnav2" rel="tooltip" title="Guarda tutte le edizioni">Edizioni</a></li>
              <li
                @if($active == 'series')
                  class="active"
                @endif
              ><a href="{{ URL::home() }}serie" id="tipsnav3" rel="tooltip" title="Elenco di tutte le serie partecipanti">Serie</a></li>
              <li
                @if($active == 'winners')
                  class="active"
                @endif
              ><a href="{{ URL::home() }}vincitori" id="tipsnav4" rel="tooltip" title="Tutti i vincitori delle edizioni passate">Vincitori</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>