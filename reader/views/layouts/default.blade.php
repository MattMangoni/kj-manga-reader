<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Komixjam Manga Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    {{ HTML::style('css/bootstrap.min.css') }}

    <style>
      body {
        padding-top: 60px;  /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    {{ HTML::style('css/styles.css') }}

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

  	@include('home.partials.navigation')

    @yield('sidebar')
    @yield('main')

    <br />

    <div class="container">
      <div class="row" style="text-align: center;">
        <div class="span12 nav-header"><h6>Copyright &copy; 2012 Komixjam.it</h6>
          <br /><br />
        </div>
      </div>
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
    </script>

  </body>
</html>