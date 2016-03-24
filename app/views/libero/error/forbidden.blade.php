@extends('layout.main')
@section('content')
<div class="content-head">
	<ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
		<li class="active">Forbidden (403)</li>
	</ul>
	<h2>Forbidden!</h2>
	<div class="muted">
		The page you are looking for was forbidden.
	</div>
</div>
@stop