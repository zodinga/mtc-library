<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{{get_setting('site_title')}}</title>
	<!--ICONS-->
	<link href="{{ asset('templates/hyper/fonts/font-awesome/css/font-awesome.min.css?v=4.0.3')}}" rel="stylesheet">
	<!--CUSTOM CSS-->
	<link media="screen, print" type="text/css" href="{{ asset('templates/css/print.css') }}" rel="stylesheet" />
	<script src="{{ asset('templates/hyper/js/libs/jquery-1.10.2.min.js')}}"></script>
	<script src="{{ asset('lib/jquery-barcode.min.js') }}"></script></head>
<body>
@yield('content')
</body>
</html>