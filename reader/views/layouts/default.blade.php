<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Komixjam Manga Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Manga Reader ufficiale del Komixjam Manga Project">
    <meta name="author" content="Matteo AoiKage Mangoni">

    <!-- Le styles -->
    {{ HTML::style('css/bootstrap.min.css') }}

    {{ HTML::style('css/styles.css') }}

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body id="default">

  	@include('home.partials.navigation')
    @include('home.partials.header')

    @yield('sidebar')
    @yield('main')

    <br />

    <div id="footer" class="container">
      <div class="row" style="text-align: center;">
        <div class="nav-header">Copyright &copy; 2012 Komixjam.it</div>
          <img src="{{ URL::home() }}img/icon-html5.png" alt="Icon HTML5">
          <img src="{{ URL::home() }}img/icon-css3.png" alt="Icon CSS3">
        </div>
      </div>
      <br /><br />
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery.js"') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/script.js') }}

    <script type="text/javascript">
      $("#tipsnav").tooltip({  placement: 'bottom' });
      $("#tipsnav2").tooltip({ placement: 'bottom' });
      $("#tipsnav3").tooltip({ placement: 'bottom' });
      $("#tipsnav4").tooltip({ placement: 'bottom' });
      $('.carousel').carousel()
    </script>

  </body>
</html>