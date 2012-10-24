<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Online Manga Reader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    {{ HTML::style('css/bootstrap.min.css') }}

    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    {{ HTML::style('css/styles.css') }}

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Manga Reader</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="#">Home</a></li>
              <li class="dropdown" id="edizioni">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#edizioni">
                  Edizioni
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Aggiungi Edizione</a></li>
                  <li><a href="#">Gestione Edizioni</a></li>
                </ul>
             </li>
            <li class="dropdown" id="serie">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#serie">
                Serie
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#">Aggiungi Serie</a></li>
                <li><a href="#">Gestione Serie</a></li>
              </ul>
             </li>
            <li class="dropdown" id="capitoli">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#capitoli">
                Capitoli
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#">Aggiungi Capitolo</a></li>
                <li><a href="#">Gestione Capitoli</a></li>
              </ul>
             </li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Manga Reader Admin Panel</h1>
      <br />

      <div class="row">

        <div class="span3">

          <div class="well" style="padding: 8px 0;">

            <ul class="nav nav-list">
              <li class="active">
                <a href="#">
                  <i class="icon-white icon-home"></i>
                  Home Pannello
                </a>
              </li>
              <li class="nav-header">
                Edizioni
              </li>

              <li>
                <a href="#">
                  <i class="icon-book"></i>
                  Aggiungi Edizione
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="icon-book"></i>
                  Gestisci Edizioni
                </a>
              </li>

              <li class="nav-header">
                Serie
              </li>

              <li>
                <a href="#">
                  <i class="icon-book"></i>
                  Aggiungi Serie
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="icon-book"></i>
                  Gestione Serie
                </a>
              </li>

              <li class="nav-header">
                Capitoli
              </li>

              <li>
                <a href="#">
                  <i class="icon-book"></i>
                  Aggiungi Capitolo
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="icon-book"></i>
                  Gestione Capitoli
                </a>
              </li>

            </ul>

          </div>

        </div>

        <div class="span9">

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
            <p>
              <a class="btn btn-primary btn-large">Gestione Edizioni</a>
              <a class="btn btn-info btn-large">Gestione Serie</a>
              <a class="btn btn-success btn-large">Gestione Capitoli</a>
            </p>
          </div>

        </div>

      </div>

    </div> <!-- /container -->

    <div class="container">
      <div class="row">
        <div class="span12 well" style="text-align: center;">
          <p>Copyright &copy; 2012 Komixjam.it</p>
        </div>
      </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ HTML::script('js/bootstrap.min.js') }}

  </body>
</html>