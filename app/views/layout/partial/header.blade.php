<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>{{get_setting('site_title')}}</title>

	<!--<link rel='stylesheet' type='text/css' href="{{asset('templates/fonts/hyper/all.css')}}">-->
	
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('templates/hyper/bootstrap/css/bootstrap.min.css?v=3.0.2')}}" rel="stylesheet">

	<!-- Font Awesome CSS -->
	<link href="{{ asset('templates/hyper/fonts/font-awesome/css/font-awesome.min.css?v=4.0.3')}}" rel="stylesheet">

	<!-- Icomoon CSS -->
	<link href="{{ asset('templates/hyper/fonts/icomoon/style.css')}}" rel="stylesheet">

	<!-- Animate CSS -->
	<link href="{{ asset('templates/hyper/css/libs/animate.min.css')}}" rel="stylesheet">

	<!-- Bootstrap Switch -->
	<link href="{{ asset('templates/hyper/css/libs/bootstrap-switch.css')}}" rel="stylesheet">

	<!-- Bootstrap Select -->
	<link href="{{ asset('templates/hyper/css/libs/bootstrap-select.min.css')}}" rel="stylesheet">

	<!-- Bootstrap WYSIHTML5 -->
	<link href="{{ asset('templates/hyper/css/libs/bootstrap-wysihtml5.css')}}" rel="stylesheet">

	<!-- jQuery Fullcalendar -->
	<link href="{{ asset('templates/hyper/css/libs/fullcalendar.css')}}" rel="stylesheet">

	<!-- jVectorMap -->
	<link href="{{ asset('templates/hyper/css/libs/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet">

	<!-- Prism -->
	<link href="{{ asset('templates/hyper/css/libs/prism.css')}}" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="{{ asset('templates/hyper/css/styler/style.css')}}" rel="stylesheet" type="text/css">
	<!-- <link href="{{ asset('templates/hyper/css/demo.css') }}" rel="stylesheet" type="text/css"> -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<link href="{{ asset('templates/css/main.css') }}" rel="stylesheet" type="text/css">
	<link media="print" href="{{ asset('templates/css/print.css') }}" rel="stylesheet" type="text/css">
	
	<!-- jQuery -->
	<script src="{{ asset('templates/hyper/js/libs/jquery-1.10.2.min.js')}}"></script>
</head>

<body>
<div id="screen_area">

<div id="wrapper">

	<div id="sidebar">
		<div class="inner">
			@if(Auth::check())
				@if(Auth::user()->role == 'administrator')
					@include('layout.partial.sidebar-administrator')
				@elseif(Auth::user()->role == 'principal')
					@include('layout.partial.sidebar-principal')
				@endif
			@else
				@include('layout.partial.sidebar')
			@endif
		</div>
	</div>

	<div id="middle">
		<header id="header">
			<nav class="navbar navbar-default">
				<div class="navbar-switcher">
					<button type="button" class="navbar-toggle" data-toggle="side-menu" data-target="#sidebar">
						<span class="sr-only">Toggle Sidebar</span>
						<i class="fa fa-bars"></i>
					</button>
				</div>

				<div class="navbar-switcher navbar-switcher-right">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#topnav">
						<span class="sr-only">Toggle Menu</span>
						<i class="fa fa-bars"></i>
					</button>
				</div>

				<div class="navbar-header">
					<a class="navbar-brand" id="brand" href="{{(Auth::check())?url('/dashboard'):url('/')}}">{{ get_setting('site_title') }}</a>
				</div>

				
				@if(Auth::check() && Auth::user()->role == 'administrator')
				<div class="collapse navbar-collapse" id="topnav">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-gear"></i> Users Manager <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li {{Request::path() == 'user/create'?'class="active"':''}}><a href="{{url('user/create')}}">Add New User</a></li>
								<li {{Request::path() == 'user'?'class="active"':''}}><a href="{{url('user')}}">User List</a></li>
							</ul>
						</li>
						<li {{Request::path() == 'settings'?'class="active"':''}}><a href="{{url('settings')}}"><i class="fa fa-wrench"></i> Settings</a></li>
					</ul>
				</div>
				@endif

			</nav>
		</header><!-- /#header -->