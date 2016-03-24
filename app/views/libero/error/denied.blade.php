@extends('layout.main')
@section('content')
<div class="content-head">
	<ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
		<li class="active">Access Denied</li>
	</ul>
	<h2>Access Denied!</h2>
	<div class="muted">
		Access to this page was denied.
	</div>
</div>
@stop