<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Google Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	<!-- Bootstrap -->
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/admin.style.css') }}
</head>
<body class="container">
	<div class="row">
		<div id="form-container" class="span4 offset3 well">
			<h1>Login</h1><br />
			@if($errors->has())
				<div class="alert alert-error">
					{{ $errors->first('username', ':message<br />') }}
					{{ $errors->first('password') }}
				</div>
			@endif

			{{ Session::get('status') }}

			{{ Form::open() }}

			{{ Form::token() }}
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username', null, array('class' => 'span4', 'placeholder' => 'Username...')); }}
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password', array('class' => 'span4', 'placeholder' => 'Password...')); }}<br /><br />

			{{ Form::submit('Effettua il login', array('class' => 'btn btn-large btn-info')) }}

			{{ Form::close() }}
		</div>
	</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery.js"') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/script.js') }}
  </body>
  </html>