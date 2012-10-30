<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Komixjam Manga Project - Pannello di Amministrazione</title>
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
          <a class="brand" href="{{ URL::home() }}">Komixjam Manga Reader</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="{{ URL::home() }}admin/">Dashboard</a></li>
              <li>{{ HTML::link('logout', 'Logout') }}</li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
          <div class="span12">
            <div class="page-header">
                <h1>Pannello di amministrazione</h1>
              </div>
          </div>
      </div>

      <div class="row">

        <div class="span3">

          <div class="well" style="padding: 8px 0;">

            <ul class="nav nav-list">
              <li><a href="{{ URL::home() }}admin/"> <i class="icon-home"></i> Home Pannello</a></li>

              <li class="nav-header">Edizioni</li>
              <li>{{ HTML::link('admin/editions', 'Elenco Edizioni') }}</li>
              <li>{{ HTML::link('admin/editions/new', 'Aggiungi Edizione') }}</li>

              <li class="nav-header">Serie</li>
              <li>{{ HTML::link('admin/series', 'Elenco Serie') }}</li>
              <li>{{ HTML::link('admin/series/new', 'Aggiungi Serie') }}</li>

              <li class="nav-header">Capitoli</li>
              <li>{{ HTML::link('admin/chapters', 'Elenco Capitoli') }}</li>
              <li>{{ HTML::link('admin/chapters/new', 'Aggiungi Capitoli') }}</li>
            </ul>

          </div>

        </div>

        <div class="span9">

          @yield('content')

        </div>

      </div>

    </div> <!-- /container -->

    <div class="container">
      <div class="row">
        <div class="span12 nav-header" style="text-align: center;">
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