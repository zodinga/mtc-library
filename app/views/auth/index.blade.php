<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Sign In - {{get_setting('site_title')}}</title>

		<!-- Fonts -->
		<!-- <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic">
		<link href='http://fonts.googleapis.com/css?family=Share+Tech' rel='stylesheet' type='text/css'> -->
		<link rel='stylesheet' type='text/css' href="{{asset('templates/fonts/hyper/all.css')}}">
		
		<!-- Bootstrap core CSS -->
		<link href="{{ asset('templates/hyper/bootstrap/css/bootstrap.min.css?v=3.0.2') }}" rel="stylesheet">

		<!-- Font Awesome CSS -->
		<link href="{{ asset('templates/hyper/fonts/font-awesome/css/font-awesome.min.css?v=4.0.3') }}" rel="stylesheet">

		<!-- Icomoon CSS -->
		<link href="{{ asset('templates/hyper/fonts/icomoon/style.css') }}" rel="stylesheet">

		<!-- Animate CSS -->
		<link href="{{ asset('templates/hyper/css/libs/animate.min.css') }}" rel="stylesheet">

		<!-- Bootstrap Switch -->
		<link href="{{ asset('templates/hyper/css/libs/bootstrap-switch.css') }}" rel="stylesheet">

		<!-- Bootstrap Select -->
		<link href="{{ asset('templates/hyper/css/libs/bootstrap-select.min.css') }}" rel="stylesheet">

		<!-- Bootstrap WYSIHTML5 -->
		<link href="{{ asset('templates/hyper/css/libs/bootstrap-wysihtml5.css') }}" rel="stylesheet">

		<!-- jQuery Fullcalendar -->
		<link href="{{ asset('templates/hyper/css/libs/fullcalendar.css') }}" rel="stylesheet">

		<!-- jVectorMap -->
		<link href="{{ asset('templates/hyper/css/libs/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">

		<!-- Prism -->
		<link href="{{ asset('templates/hyper/css/libs/prism.css') }}" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="{{ asset('templates/hyper/css/styler/style.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('templates/hyper/css/demo.css') }}" rel="stylesheet" type="text/css">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div id="wrapper">
<section id="middle" class="no-sidebar border-top">

	<div id="content">

		<div class="section-content">
			<div class="header align-center">
				<a id="brand" class="circle" href="{{url('auth')}}">login</a>
			</div>
		</div>

		<div class="section-content section-content-dark signin-page">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-lg-offset-4 col-md-offset-3">
						{{ Form::open(array('url'=>url('auth'), 'class'=>'form-signin', 'role'=>'form')) }}
							
							{{ Form::text('username', '', array('class'=>'form-control input-lg', 'placeholder'=>'Username', 'required', 'autofocus')) }}
							{{ Form::password('password', array('class'=>'form-control input-lg', 'placeholder'=>'Password', 'required')) }}
							<label class="checkbox">
								{{ Form::checkbox('remember', 'remember-me') }} Remember me
							</label>

							<button name="signin" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
							<button name="signin" class="btn btn-lg btn-warning btn-block" type="button" onclick="location.href='http://mtc-library.com'">Back to Home</button>

						{{ Form::close() }}
					</div>
				</div>
			</div> <!-- /container -->
		</div>

		<div class="section-content signin-page">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-lg-offset-4 col-md-offset-3">
						@if(get_setting('logo') != null)
						<p class="text-center"><img src="{{ asset(get_setting('logo')) }}" /></p>
						@endif
					</div>
				</div>
			</div>
		</div>

	</div>

</section>

		</div><!-- /#wrapper -->
		
		<footer id="footer">
			<div class="row">
				<div class="col-xs-6">
					<ul class="list-inline">
						<li>{{get_setting('copyright')}}</li>
					</ul>
				</div>
				<div class="col-xs-6">
					
				</div>
			</div>
		</footer>

		<!-- jQuery -->
		<script src="{{ asset('templates/hyper/js/libs/jquery-1.10.2.min.js') }}"></script>

		<!-- jQuery UI -->
		<script src="{{ asset('templates/hyper/js/libs/jquery-ui.min.js') }}"></script>

		<!-- Bootstrap core JavaScript -->
		<script src="{{ asset('templates/hyper/bootstrap/js/bootstrap.min.js?v=3.0.2') }}"></script>

		<!-- jQuery Transit -->
		<script src="{{ asset('templates/hyper/js/libs/jquery.transit.min.js?v=0.9.9') }}"></script>

		<!-- Bootstrap Switch -->
		<script src="{{ asset('templates/hyper/js/libs/bootstrap-switch.js') }}"></script>

		<!-- Bootstrap Select -->
		<script src="{{ asset('templates/hyper/js/libs/bootstrap-select.min.js') }}"></script>

		<!-- Bootstrap File -->
		<script src="{{ asset('templates/hyper/js/libs/bootstrap-filestyle.js') }}"></script>

		<script src="{{ asset('templates/hyper/js/libs/wysihtml5-0.3.0.min.js') }}"></script>

		<!-- Bootstrap WYSIHTML5 -->
		<script src="{{ asset('templates/hyper/js/libs/bootstrap-wysihtml5.js') }}"></script>

		<!-- jQuery FullCalendar -->
		<script src="{{ asset('templates/hyper/js/libs/fullcalendar.min.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/libs/gcal.js') }}"></script>

		<!-- Prism -->
		<script src="{{ asset('templates/hyper/js/libs/prism.js') }}"></script>

		<!-- jVectorMap -->
		<script src="{{ asset('templates/hyper/js/libs/jquery-jvectormap-1.2.2.min.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/libs/jquery-jvectormap-world-mill-en.js') }}"></script>

		<!-- Flot -->
		<script src="{{ asset('templates/hyper/js/libs/jquery.flot.min.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/libs/jquery.flot.time.min.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/libs/jquery.flot.pie.min.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/libs/jquery.flot.resize.min.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/libs/jquery.flot.stack.min.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/libs/jquery.flot.tooltip.min.js') }}"></script>

		<!-- Sparkline -->
		<script src="{{ asset('templates/hyper/js/libs/jquery.sparkline.min.js') }}"></script>

		<!-- Prism -->
		<script src="{{ asset('templates/hyper/js/libs/jquery.sparkline.min.js') }}"></script>

		<!-- jQuery EqualHeights -->
		<script src="{{ asset('templates/hyper/js/libs/jquery.equalheights.min.js') }}"></script>

		<!-- jQuery Nicescroll -->
		<script src="{{ asset('templates/hyper/js/libs/jquery.nicescroll.min.js') }}"></script>

		<!-- Theme script -->
		<script src="{{ asset('templates/hyper/js/styler/script.js') }}"></script>
		<script src="{{ asset('templates/hyper/js/styler/sample_graphs.js') }}"></script>
	</body>
</html>