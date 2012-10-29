    <div class="navbar navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="{{ URL::home() }}">Komixjam Manga Project</a>

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
           @if(! Auth::guest())
              <li>{{ HTML::link('admin/', 'Amministrazione') }}</li>
            @endif
            <li>
              @if(Auth::guest())
                {{ HTML::link('login', 'Login') }}
              @else
                {{ HTML::link('logout', 'Logout') }}
              @endif
            </li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>