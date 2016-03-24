<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{get_setting('site_title')}}</title>
	<!-- BOOTSTRAPS -->
	<link type="text/css" href="{{ asset('templates/libero/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- THEMES -->
	<link type="text/css" href="{{ asset('templates/libero/css/theme.css') }}" rel="stylesheet">
	<!--ICONS-->
	<link type="text/css" href="{{ asset('templates/libero/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<!--Custom CSS-->
	<link type="text/css" href="{{ asset('templates/libero/css/custom-login.css') }}" rel="stylesheet">
	<!--JAVASCRIPTS-->
	<script src="{{ asset('templates/libero/js/jquery-1.9.1.min.js') }}"></script>
	<script src="{{ asset('templates/libero/js/jquery-ui-1.10.1.custom.min.js') }}"></script>
	<script src="{{ asset('templates/libero/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
<div class="frame">
	<div class="form-login">
		<div class="container">
			<div class="row-fluid">
				<div class="span4 offset4">
					{{ Form::open(array('url'=>'/auth', 'class'=>'form')) }}

						@if(get_setting('logo') != null)
						<p class="text-center"><img src="{{ asset(get_setting('logo')) }}" /></p>
						@endif

						<h1 class="brand text-center" style="font-size: 30px; margin-bottom: 30px">library login</h1>
						<hr>
						<p class="account-username">{{ Form::text('username', '', array('placeholder'=>'Username', 'class'=>'span12')) }}</p>
						<p class="account-password">{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'span12')) }}</p>
						<button type="submit" name="signin" class="btn btn-block btn-large btn-primary">Sign In</button>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- THEME -->
<script src="{{ asset('templates/libero/js/theme.js') }}"></script>
</body>
</html>