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
	<!--CUSTOM CSS-->
	<link type="text/css" href="{{ asset('templates/libero/css/custom.css') }}" rel="stylesheet">
	<!--JAVASCRIPTS-->
	<script src="{{ asset('templates/libero/js/jquery-1.9.1.min.js') }}"></script>
	<script src="{{ asset('templates/libero/js/jquery-ui-1.10.1.custom.min.js') }}"></script>
	<script src="{{ asset('templates/libero/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('lib/jquery-barcode.min.js') }}"></script>
	<!--CUSTOM JS-->
	<script src="{{ asset('templates/libero/js/custom.js') }}"></script>
</head>
<body>
<div class="frame">
	@if(Auth::check())
		@if(Auth::user()->role == 'administrator')
			@include('layout.partial.sidebar-administrator')
		@elseif(Auth::user()->role == 'principal')
			@include('layout.partial.sidebar-principal')
		@endif
	@else
		@include('layout.partial.sidebar')
	@endif
	
	<div class="content">
		<div class="navbar navbar-static-tops">
			<div class="navbar-inner">
				<a href="javascript:void(0);" class="btn pull-left toggle-sidebar hidden-desktop"><i class="icon-reorder"></i></a>
				<a class="brand" href="{{(Auth::check())?url('/dashboard'):url('/')}}">{{ get_setting('site_title') }}</a>
			</div>
		</div><!--/.navbar -->
